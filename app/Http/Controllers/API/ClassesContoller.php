<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AttendanceModel;
use App\Models\BoardingAttendanceModel;
use App\Models\BursaryFeesModel;
use App\Models\ClassessModel;
use App\Models\FeesBalanceModel;
use App\Models\FeesDetailsModel;
use App\Models\FeesPaymentModel;
use App\Models\MarksModel;
use App\Models\StaffModel;
use App\Models\StudentActivationMode;
use App\Models\StudentModel;
use App\Models\StudentOptionsModel;
use App\Models\SubjectAssessmentsModel;
use App\Models\SubjectGradeModel;
use App\Models\SubjectModel;
use App\Models\ThirdTermMarks;
use App\Models\UselModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class ClassesContoller extends Controller
{
    public $feesreference;
    public $students;
    public $staffid;
    public $A1, $A2, $A3, $A4, $A5, $A6, $A7, $A8, $A9, $A10;
    public function index()
    {
        $classes = ClassessModel::All();
        if ($classes->count() > 0) {
            return response()->json([
                'statusCode' => 200,
                'classes' => $classes
            ]);
        } else {
            return response()->json([
                'statusCode' => 202,
                'message' => 'No Records Found'
            ]);
        }
    }
    public function houses()
    {
        $houses = StudentModel::select('House')->distinct()->get();
        if ($houses->count() > 0) {
            return response()->json([
                'statusCode' => 200,
                'houses' => $houses
            ]);
        } else {
            return response()->json([
                'statusCode' => 202,
                'message' => 'No Records Found'
            ]);
        }
    }

    public function bursarys()
    {
        $bursarys = BursaryFeesModel::All();
        if ($bursarys->count() > 0) {
            return response()->json([
                'statusCode' => 200,
                'bursarys' => $bursarys
            ]);
        }
    }
    public function subjects(Request $request)
    {
        $staffdetails = StaffModel::where('UserAccount', $request->TeacherID)->first();
        if ($staffdetails) {
            $this->staffid = $staffdetails->id;
        }
        $subjects = SubjectModel::where('ClassName', $request->selectedClass)->where('Teacher', $this->staffid)->get();
        if ($subjects->count() > 0) {
            return response()->json([
                'statusCode' => 200,
                'subjects' => $subjects
            ]);
        } else {
            return response()->json([
                'statusCode' => 202,
                'message' => 'No Records Found'
            ]);
        }
    }
    public function subjectsOption(Request $request)
    {
        $staffdetails = StaffModel::where('UserAccount', $request->TeacherID)->first();
        if ($staffdetails) {
            $this->staffid = $staffdetails->id;
        }
        $subjects = SubjectModel::where('ClassName', $request->selectedClass)->where('Teacher', $this->staffid)->where('Undertaking', 'Optional')->get();
        if ($subjects->count() > 0) {
            return response()->json([
                'statusCode' => 200,
                'subjects' => $subjects
            ]);
        } else {
            return response()->json([
                'statusCode' => 202,
                'message' => 'No Records Found'
            ]);
        }
    }
    public function assessments(Request $request)
    {
        $assessments = SubjectAssessmentsModel::where('SubjectID', $request->selectedSubject)->get();
        if ($assessments->count() > 0) {
            return response()->json([
                'statusCode' => 200,
                'assessments' => $assessments
            ]);
        } else {
            return response()->json([
                'statusCode' => 202,
                'message' => 'No Records Found'
            ]);
        }
    }


    public function students(Request $request)
    {
        //Log::info('Incoming Request:', ['request' => $request->all()]);
        $selectedsubjects = SubjectModel::where('id', $request->selectedsubject)->first();
        if ($selectedsubjects->Undertaking == "Compulsory") {
            $this->students = StudentModel::where('StudentClass', $request->StudentClass)->where('Stream', $request->StudentStream)->where('StudyYear', $request->StudentYear)->where('StudyTerm', $request->StudentTerm)->orderBy('StudentName', 'ASC')->get();
        } else {
            $this->students = StudentOptionsModel::where('ClassName', $request->StudentClass)->where('Stream', $request->StudentStream)->where('StudyYear', $request->StudentYear)->where('Subject', $request->selectedsubject)->with('hasstudent', 'hassubject', 'hasclasses')->get();
        }
        //Log::info($this->students);
        if ($this->students->count() > 0) {
            return response()->json([
                'statusCode' => 200,
                'students' => $this->students
            ]);
        } else {
            return response()->json([
                'statusCode' => 202,
                'message' => 'No Records Found'
            ]);
        }
    }
    public function studentsOptions(Request $request)
    {

        $this->students = StudentModel::where('StudentClass', $request->StudentClass)->where('Stream', $request->StudentStream)->where('StudyYear', $request->StudentYear)->orderBy('StudentName', 'ASC')->get();
        if ($this->students->count() > 0) {
            return response()->json([
                'statusCode' => 200,
                'students' => $this->students
            ]);
        } else {
            return response()->json([
                'statusCode' => 202,
                'message' => 'No Records Found'
            ]);
        }
    }

    public function boardingstudents(Request $request)
    {
        $this->students = StudentModel::where('House', $request->StudentHouse)->where('StudyYear', $request->StudentYear)->where('StudyTerm', $request->selectedTerm)->where('StudentType', 'Boarding')->orderBy('StudentName', 'ASC')->get();
        if ($this->students->count() > 0) {
            return response()->json([
                'statusCode' => 200,
                'students' => $this->students
            ]);
        } else {
            return response()->json([
                'statusCode' => 202,
                'message' => 'No Records Found'
            ]);
        }
    }

    public function updateprofile(Request $request)
    {

        $request->validate([
            'fullnames' => 'required',
            'emailaddress' => 'required',
            'passwords' => 'required',
            'userid' => 'required',
        ]);
        try {
            $userprofile = UselModel::find($request->userid);
            $userprofile->name = $request->fullnames;
            $userprofile->email = $request->emailaddress;
            $userprofile->password = Hash::make($request->passwords);
            $userprofile->save();
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return response()->json([
            'statusCode' => 200,
            'message' => 'Records Saved Successsfully'
        ]);
    }
    public function assessmentregistration(Request $request)
    {
        $request->validate([
            'SelectedClass' => 'required',
            'SelectedSubject' => 'required',
            'StudyTerm' => 'required',
            'AssessmentNo' => 'required',
            'AssessmentName' => 'required',
        ]);
        try {
              $checkregistration =  SubjectAssessmentsModel::where('SubjectID', $request->SelectedSubject)->where('ClassName', $request->SelectedClass)->where('AssessmentNo', $request->AssessmentNo)->where('Term', $request->StudyTerm)->first();
            if ($checkregistration) {
            } else {
                $registerAssessment = new SubjectAssessmentsModel();
                $registerAssessment->ClassName = $request->SelectedClass;
                $registerAssessment->SubjectID = $request->SelectedSubject;
                $registerAssessment->Term = $request->StudyTerm;
                $registerAssessment->AssessmentNo = $request->AssessmentNo;
                $registerAssessment->AssessmentName = $request->AssessmentName;
                $registerAssessment->save();
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return response()->json([
            'statusCode' => 200,
            'message' => 'Records Saved Successsfully'
        ]);
    }
    public function studentregistration(Request $request)
    {
       

        $request->validate([
            'AdmissionDate' => 'required',
            'LIN' => 'required',
            'FeesCode' => 'required',
            'ImageData' => 'required|mimes:jpeg,png',
            'StudentName' => 'required',
            'Nationality' => 'required',
            'Residence' => 'required',
            'ContactNo' => 'required',
            'EmailAddress' => 'required',
            'Gender' => 'required',
            'Category' => 'required',
            'Religion' => 'required',
            'StudentClass' => 'required',
            'Stream' => 'required',
            'StudyTerm' => 'required',
            'StudyYear' => 'required',
            'DOB' => 'required',
            'StudentType' => 'required',
            'House' => 'required',
            'SchoolFees' => 'required|numeric',
            'Bursary' => 'required',
            'OtherDetails' => 'required',
        ]);
        try {
            if ($request->Bursary == "None") {
                $feescollection = FeesDetailsModel::where('StudentType', $request->StudentType)->where('ClassName', $request->StudentClass)->where('Term', $request->StudyTerm)->where('Nationality', $request->Nationality)->orderby('id', 'DESC')->first();
                if ($feescollection) {
                    $this->feesreference = $feescollection->id;
                } else {
                    return;
                }
            } else {
                $feescollection = BursaryFeesModel::where('Particular', $request->Bursary)->where('StudentType', $request->StudentType)->where('ClassName', $request->StudentClass)->where('Term', $request->StudyTerm)->where('Nationality', $request->Nationality)->orderby('id', 'DESC')->first();
                if ($feescollection) {
                    $this->feesreference = $feescollection->id;
                } else {
                    return;
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        try {
            $parsedAdmissionDate = Carbon::createFromFormat('d/m/Y', $request->AdmissionDate);
            $formattedAdmissionDate = $parsedAdmissionDate->format('Y-m-d');
            $parseddobDate = Carbon::createFromFormat('d/m/Y', $request->DOB);
            $formatteddobDate = $parseddobDate->format('Y-m-d');

            $checkifstudentextist = StudentModel::where('LIN', $request->LIN)->orWhere('FeesCode', $request->FeesCode)->first();
            if ($checkifstudentextist) {
            } else {
                $registerstudent = new StudentModel();
                $registerstudent->AdmissionDate = $formattedAdmissionDate;
                $registerstudent->LIN = $request->LIN;
                $registerstudent->FeesCode = $request->FeesCode;
                $registerstudent->StudentName = $request->StudentName;
                $registerstudent->Nationality = $request->Nationality;
                $registerstudent->Residence = $request->Residence;
                $registerstudent->ContactNo = $request->ContactNo;
                $registerstudent->EmailAddress = $request->EmailAddress;
                $registerstudent->Gender = $request->Gender;
                $registerstudent->Category = $request->Category;
                $registerstudent->Religion = $request->Religion;
                $registerstudent->StudentClass = $request->StudentClass;
                $registerstudent->Stream = $request->Stream;
                $registerstudent->StudyTerm = $request->StudyTerm;
                $registerstudent->DOB = $formatteddobDate;
                $registerstudent->StudentType = $request->StudentType;
                $registerstudent->SchoolFees = $request->SchoolFees;
                $registerstudent->StudyYear = $request->StudyYear;
                $registerstudent->House = $request->House;
                $registerstudent->Bursary = $request->Bursary;
                $registerstudent->OtherDetails = $request->OtherDetails;
                $image = $request->file('ImageData');
                $registerstudent->ProfilePic = $request->LIN . '.' . $image->getClientOriginalExtension();
                $profilepic = $request->LIN . '.' . $image->getClientOriginalExtension();
                $request->file('ImageData')->storeAs('StudentProfilePics', $profilepic);
                $registerstudent->save();
                $newId = $registerstudent->id;

                $studentPromotion = new StudentActivationMode();
                $studentPromotion->StudentRefferID = $newId;
                $studentPromotion->LIN = $request->LIN;
                $studentPromotion->ClassName = $request->StudentClass;
                $studentPromotion->StudyYear = $request->StudyYear;
                $studentPromotion->Stream = $request->Stream;
                $studentPromotion->Term = $request->StudyTerm;
                $studentPromotion->Bursary = $request->Bursary;
                $studentPromotion->save();

                $MakeFeesPayment = new FeesPaymentModel();
                $MakeFeesPayment->StudentRefferID = $newId;
                $MakeFeesPayment->FeesRefferID = $this->feesreference;
                $MakeFeesPayment->FeesCode = $request->FeesCode;
                $MakeFeesPayment->LIN = $request->LIN;
                $MakeFeesPayment->ClassName = $request->StudentClass;
                $MakeFeesPayment->Term = $request->StudyTerm;
                $MakeFeesPayment->SchoolFees = $request->SchoolFees;
                $MakeFeesPayment->Paid = 0;
                $MakeFeesPayment->Balance = $request->SchoolFees;
                $MakeFeesPayment->PaymentMethod = "Auto";
                $MakeFeesPayment->save();

                $FeesBalance = new FeesBalanceModel();
                $FeesBalance->StudentRefferID = $newId;
                $FeesBalance->FeesCode = $request->FeesCode;
                $FeesBalance->LIN = $request->LIN;
                $FeesBalance->Balance = $request->SchoolFees;
                $FeesBalance->save();
            }

        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return response()->json([
            'statusCode' => 200,
            'message' => 'Records Saved Successsfully'
        ]);
    }
    public function attendanceregistration(Request $request)
    {
        try {
 
            // Decode the JSON data from the request body into an associative array
            $studentsData = json_decode($request->getContent(), true);

            // Check if the data is not empty and is an array
            if (!empty($studentsData) && is_array($studentsData)) {
                foreach ($studentsData as $studentData) {
                    // Create an instance of AttendanceModel and set its attributes
                    if ($studentData['Presence'] == true) {
                        $registerattendance = new AttendanceModel();
                        $registerattendance->StudentRefferID = $studentData['StudentefferID'];
                        $registerattendance->ClassName = $studentData['StudentClass'];
                        $registerattendance->Term = $studentData['StudyTerm'];
                        $registerattendance->Year = $studentData['StudyYear'];
                        $registerattendance->Stream = $studentData['Stream'];
                        $registerattendance->SubjectID = $studentData['Subject'];
                        $registerattendance->LIN = $studentData['LIN'];
                        $registerattendance->AttendanceDate = now();
                        $registerattendance->Presence = 1;
                        $registerattendance->save();
                    }
                }

            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        response()->json([
            'statusCode' => 200,
            'message' => 'Records Saved Successsfully'
        ]);

    }
    public function registeroptions(Request $request)
    {
        try {

            // Decode the JSON data from the request body into an associative array
            $studentsData = json_decode($request->getContent(), true);

            // Check if the data is not empty and is an array
            if (!empty($studentsData) && is_array($studentsData)) {
                foreach ($studentsData as $studentData) {
                    // Create an instance of AttendanceModel and set its attributes
                    if ($studentData['Presence'] == true) {
                        $checkregistration = StudentOptionsModel::where('LIN', $studentData['LIN'])->where('ClassName', $studentData['StudentClass'])->where('Subject', $studentData['Subject'])->where('StudyYear', $studentData['StudyYear'])->first();
                        if ($checkregistration) {
                        } else {
                            $registeroptions = new StudentOptionsModel();
                            $registeroptions->StudentRefferID = $studentData['StudentefferID'];
                            $registeroptions->ClassName = $studentData['StudentClass'];
                            $registeroptions->Stream = $studentData['Stream'];
                            $registeroptions->Subject = $studentData['Subject'];
                            $registeroptions->LIN = $studentData['LIN'];
                            $registeroptions->StudyYear = $studentData['StudyYear'];
                            $registeroptions->save();
                        }
                    }
                }

            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        response()->json([
            'statusCode' => 200,
            'message' => 'Records Saved Successsfully'
        ]);

    }

    public function boardingattendanceregistration(Request $request)
    {
        try {

            // Decode the JSON data from the request body into an associative array
            $studentsData = json_decode($request->getContent(), true);

            // Check if the data is not empty and is an array
            if (!empty($studentsData) && is_array($studentsData)) {
                foreach ($studentsData as $studentData) {
                    // Create an instance of AttendanceModel and set its attributes
                    if ($studentData['Presence'] == true) {
                        $registerattendance = new BoardingAttendanceModel();
                        $registerattendance->StudentRefferID = $studentData['StudentefferID'];
                        $registerattendance->House = $studentData['StudentHouse'];
                        $registerattendance->Term = $studentData['StudyTerm'];
                        $registerattendance->Year = $studentData['StudyYear'];
                        $registerattendance->LIN = $studentData['LIN'];
                        $registerattendance->AttendanceDate = now();
                        $registerattendance->Presence = 1;
                        $registerattendance->save();
                    }
                }

            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        response()->json([
            'statusCode' => 200,
            'message' => 'Records Saved Successsfully'
        ]);

    }

    public function marksregistration(Request $request)
    {

        
        try {
            // Decode the JSON data from the request body into an associative array
            $studentsData = json_decode($request->getContent(), true);

            // Check if the data is not empty and is an array
            if (!empty($studentsData) && is_array($studentsData)) {

                foreach ($studentsData as $studentData) {
                    $assessmentscores = SubjectAssessmentsModel::where('AssessmentNo', $studentData['Assessment'])->where('SubjectID', $studentData['Subject'])->where('ClassName', $studentData['StudentClass'])->where('Term', $studentData['StudyTerm'])->first();
                    if ($assessmentscores) {
                        $subjectassessment = SubjectAssessmentsModel::find($assessmentscores->id);
                        $subjectassessment->MaximumScores = $studentData['MaximumScore'];
                        $subjectassessment->save();
                    }
                    // Create an instance of AttendanceModel and set its attributes
                    if ($studentData['StudyTerm'] == "3rd") {

                        if ($studentData['Assessment'] == "AOI And Projects") {
                            $checkregistration = ThirdTermMarks::where('StudentID', $studentData['StudentefferID'])->where('ClassID', $studentData['StudentClass'])->where('SubjectID', $studentData['Subject'])->where('MarksTerm', $studentData['StudyTerm'])->where('MarksYear',  $studentData['StudyYear'])->first();
                            if ($checkregistration) {
                            } else {
                                $registermarks = new ThirdTermMarks();
                                $registermarks->StudentID = $studentData['StudentefferID'];
                                $registermarks->ClassID = $studentData['StudentClass'];
                                $registermarks->SubjectID = $studentData['Subject'];
                                $registermarks->MarksYear = $studentData['StudyYear'];
                                $registermarks->MarksTerm = $studentData['StudyTerm'];
                                $registermarks->MarksStream = $studentData['Stream'];
                                if ($studentData['Marks'] == 0 || $studentData['Marks'] == "") {
                                    $registermarks->AOI = (0.9 / 3) * 20;
                                    ;
                                    $registermarks->Average = (0.9 / 3) * 20;
                                    ;
                                } else {
                                    $registermarks->AOI = $studentData['Marks'];
                                    $registermarks->Average = $studentData['Marks'];
                                }
                                $registermarks->Initials = $studentData['Initials'];
                                $registermarks->save();
                            }
                        }
                        if ($studentData['Assessment'] == "End Of Year") {
                            $marksselection1 = ThirdTermMarks::where('StudentID', $studentData['StudentefferID'])->where('MarksYear', $studentData['StudyYear'])->where('MarksTerm', $studentData['StudyTerm'])->where('SubjectID', $studentData['Subject'])->first();
                            if ($marksselection1) {
                                if ($studentData['Marks'] == 0 || $studentData['Marks'] == "") {
                                     $Averagemark = $marksselection1->AOI;
                                    $Averagemark = round($Averagemark, 0);
                                    $markid = $marksselection1->id;
                                    $gradeselection = SubjectGradeModel::where('ClassName', $studentData['StudentClass'])
                                        ->where('SubjectID', $studentData['Subject'])
                                        ->where('MinMark', '<=', $Averagemark)
                                        ->where('MaxMark', '>=', $Averagemark)
                                        ->first();
                                    if ($gradeselection) {
                                        $grades = $gradeselection->Grade;
                                        $comments = $gradeselection->Comment;
                                        $resultsupdate1 = ThirdTermMarks::find($markid);
                                        $resultsupdate1->Average = $Averagemark;
                                        $resultsupdate1->Score = $grades;
                                        $resultsupdate1->Comment = $comments;
                                        $resultsupdate1->Initials = $studentData['Initials'];
                                        $resultsupdate1->save();
                                    }
                                } else {
                                    $Averagemark = $marksselection1->AOI + (($studentData['Marks'] / $studentData['MaximumScore']) * 80);
                                    $Averagemark = round($Averagemark, 0);
                                    $markid = $marksselection1->id;
                                    $gradeselection = SubjectGradeModel::where('ClassName', $studentData['StudentClass'])
                                        ->where('SubjectID', $studentData['Subject'])
                                        ->where('MinMark', '<=', $Averagemark)
                                        ->where('MaxMark', '>=', $Averagemark)
                                        ->first();
                                    if ($gradeselection) {
                                        $grades = $gradeselection->Grade;
                                        $comments = $gradeselection->Comment;
                                        $resultsupdate1 = ThirdTermMarks::find($markid);
                                        $resultsupdate1->EOY = (($studentData['Marks'] / $studentData['MaximumScore']) * 80);
                                        $resultsupdate1->Average = $Averagemark;
                                        $resultsupdate1->Score = $grades;
                                        $resultsupdate1->Comment = $comments;
                                        $resultsupdate1->Initials = $studentData['Initials'];
                                        $resultsupdate1->save();
                                    }
                                }
                            }
                        }

                    } else {
                        if ($studentData['Assessment'] == "A1") {
                            $checkregistration = MarksModel::where('StudentID', $studentData['StudentefferID'])->where('ClassID', $studentData['StudentClass'])->where('SubjectID', $studentData['Subject'])->where('MarksTerm', $studentData['StudyTerm'])->where('MarksYear', $studentData['StudyYear'])->first();
                            if ($checkregistration) {
                            } else {
                                $registermarks = new MarksModel();
                                $registermarks->StudentID = $studentData['StudentefferID'];
                                $registermarks->ClassID = $studentData['StudentClass'];
                                $registermarks->SubjectID = $studentData['Subject'];
                                $registermarks->MarksYear = $studentData['StudyYear'];
                                $registermarks->MarksTerm = $studentData['StudyTerm'];
                                $registermarks->MarksStream = $studentData['Stream'];
                                if ($studentData['Marks'] == null || $studentData['Marks'] == "") {
                                    $registermarks->A1 = 0.9;
                                    $registermarks->Score1 = (0.9 * $studentData['MaximumScore']) / 3;
                                    $registermarks->Average = 0.9;
                                    $registermarks->Identifier = 1;
                                } else {
                                    $registermarks->A1 = ($studentData['Marks'] / $studentData['MaximumScore']) * 3;
                                    $registermarks->Score1 = $studentData['Marks'];
                                    $registermarks->Average = $studentData['Marks'];
                                    $registermarks->Identifier = $studentData['Marks'];
                                }
                                $registermarks->Initials = $studentData['Initials'];
                                $registermarks->save();
                            }
                        }
                        $marksselection1 = MarksModel::where('StudentID', $studentData['StudentefferID'])->where('MarksYear', $studentData['StudyYear'])->where('MarksTerm', $studentData['StudyTerm'])->where('SubjectID', $studentData['Subject'])->first();
                        if ($marksselection1) {
                            $resultsupdate1 = MarksModel::find($marksselection1->id);
                            if ($studentData['Assessment'] == "A2") {
                                if ($studentData['Marks'] == null  || $studentData['Marks'] == "") {
                                    $resultsupdate1->A2 = 0.9;
                                   $resultsupdate1->Score2 = ((0.9 *  $studentData['MaximumScore']) / 3);
                                }else {
                                    $resultsupdate1->A2 = ($studentData['Marks'] / $studentData['MaximumScore']) * 3;
                                    $resultsupdate1->Score2 = $studentData['Marks'];
                                }

                            } else if ($studentData['Assessment'] == "A10") {
                                if ($studentData['Marks'] == null || $studentData['Marks'] == "") {
                                    $resultsupdate1->A10 = 0.9;
                                    $resultsupdate1->Score10 = (0.9 *  $studentData['MaximumScore']) / 3;
                                } else {
                                    $resultsupdate1->A10 = ($studentData['Marks'] / $studentData['MaximumScore']) * 3;
                                    $resultsupdate1->Score10 = $studentData['Marks'];
                                }
                            } else if ($studentData['Assessment'] == "A3") {
                                 if ($studentData['Marks'] == null || $studentData['Marks'] == "") {
                                    $resultsupdate1->A3 = 0.9;
                                    $resultsupdate1->Score3 = (0.9 *  $studentData['MaximumScore']) / 3;
                                } else {
                                    $resultsupdate1->A3 = ($studentData['Marks'] / $studentData['MaximumScore']) * 3;
                                    $resultsupdate1->Score3 = $studentData['Marks'];
                                }
                            } else if ($studentData['Assessment'] == "A4") {
                                 if ($studentData['Marks'] == null || $studentData['Marks'] == "") {
                                    $resultsupdate1->A4 = 0.9;
                                    $resultsupdate1->Score4 = (0.9 *  $studentData['MaximumScore']) / 3;
                                } else {
                                    $resultsupdate1->A4 = ($studentData['Marks'] / $studentData['MaximumScore']) * 3;
                                    $resultsupdate1->Score4 = $studentData['Marks'];
                                }
                            } else if ($studentData['Assessment'] == "A5") {
                                 if ($studentData['Marks'] == null || $studentData['Marks'] == "") {
                                    $resultsupdate1->A5 = 0.9;
                                   $resultsupdate1->Score5 = (0.9 *  $studentData['MaximumScore']) / 3;
                                } else {
                                    $resultsupdate1->A5 = ($studentData['Marks'] / $studentData['MaximumScore']) * 3;
                                    $resultsupdate1->Score5 = $studentData['Marks'];
                                }
                            } else if ($studentData['Assessment'] == "A6") {
                                 if ($studentData['Marks'] == null || $studentData['Marks'] == "") {
                                    $resultsupdate1->A6 = 0.9;
                                   $resultsupdate1->Score6 = (0.9 *  $studentData['MaximumScore']) / 3;
                                } else {
                                    $resultsupdate1->A6 = ($studentData['Marks'] / $studentData['MaximumScore']) * 3;
                                    $resultsupdate1->Score6 = $studentData['Marks'];
                                }
                            } else if ($studentData['Assessment'] == "A7") {
                                 if ($studentData['Marks'] == null || $studentData['Marks'] == "") {
                                    $resultsupdate1->A7 = 0.9;
                                    $resultsupdate1->Score7 = (0.9 *  $studentData['MaximumScore']) / 3;
                                } else {
                                    $resultsupdate1->A7 = ($studentData['Marks'] / $studentData['MaximumScore']) * 3;
                                    $resultsupdate1->Score7 = $studentData['Marks'];
                                }
                            } else if ($studentData['Assessment'] == "A8") {
                                if ($studentData['Marks'] == null || $studentData['Marks'] == "") {
                                    $resultsupdate1->A8 = 0.9;
                                   $resultsupdate1->Score8 = (0.9 *  $studentData['MaximumScore']) / 3;
                                } else {
                                    $resultsupdate1->A8 = ($studentData['Marks'] / $studentData['MaximumScore']) * 3;
                                   $resultsupdate1->Score8 = $studentData['Marks'];
                                }
                            } else if ($studentData['Assessment'] == "A9") {
                                 if ($studentData['Marks'] == null || $studentData['Marks'] == "") {
                                    $resultsupdate1->A9 = 0.9;
                                    $resultsupdate1->Score9 = (0.9 *  $studentData['MaximumScore']) / 3;
                                } else {
                                    $resultsupdate1->A9 = ($studentData['Marks'] / $studentData['MaximumScore']) * 3;
                                   $resultsupdate1->Score9 = $studentData['Marks'];
                                }
                            }
                            else if ($studentData['Assessment'] == "EOT") {
                                if ($studentData['Marks'] == 0||$studentData['Marks'] == "") {
                                } else {
                                    $resultsupdate1->EOT = ($studentData['Marks'] / $studentData['MaximumScore']) * 80;
                                    $resultsupdate1->EOTRawScore = $studentData['Marks'];
                                    $marksselection10 = MarksModel::where('StudentID', $studentData['StudentefferID'])->where('MarksYear', $studentData['StudyYear'])->where('MarksTerm', $studentData['StudyTerm'])->where('SubjectID', $studentData['Subject'])->where('ClassID', $studentData['StudentClass'])->first();
                                    if ($marksselection10) {
                                        $Averagemark10 = (($marksselection10->Average / 3) * 20) + (($studentData['Marks'] / $studentData['MaximumScore']) * 80);
                                        $Averagemark10 = round($Averagemark10, 0);
                                        $gradeselection10 = SubjectGradeModel::where('ClassName', $studentData['StudentClass'])
                                            ->where('SubjectID', $studentData['Subject'])
                                            ->where('MinMark', '<=', $Averagemark10)
                                            ->where('MaxMark', '>=', $Averagemark10)
                                            ->first();
                                        if ($gradeselection10) {
                                            $grades10 = $gradeselection10->Grade;
                                            $comments10 = $gradeselection10->Comment;
                                            $resultsupdate1->Grade = $grades10;
                                            $resultsupdate1->Comment = $comments10;
                                        }

                                    }
                                }
                    }
                            $resultsupdate1->Initials = $studentData['Initials'];
                            $resultsupdate1->save();
                        }

                        $marksselection = MarksModel::where('StudentID', $studentData['StudentefferID'])->where('MarksYear', $studentData['StudyYear'])->where('MarksTerm', $studentData['StudyTerm'])->where('SubjectID', $studentData['Subject'])->first();
                        if ($marksselection) {
                            $resultpresence1 = $marksselection->A1;
                            if ($resultpresence1 == null) {
                                $this->A1 = 0;
                            } else {
                                $this->A1 = 1;
                            }
                            $resultpresence2 = $marksselection->A2;
                            if ($resultpresence2 == null) {
                                $this->A2 = 0;
                            } else {
                                $this->A2 = 1;
                            }
                            $resultpresence3 = $marksselection->A3;
                            if ($resultpresence3 == null) {
                                $this->A3 = 0;
                            } else {
                                $this->A3 = 1;
                            }
                            $resultpresence4 = $marksselection->A4;
                            if ($resultpresence4 == null) {
                                $this->A4 = 0;
                            } else {
                                $this->A4 = 1;
                            }
                            $resultpresence5 = $marksselection->A5;
                            if ($resultpresence5 == null) {
                                $this->A5 = 0;
                            } else {
                                $this->A5 = 1;
                            }
                            $resultpresence6 = $marksselection->A6;
                            if ($resultpresence6 == null) {
                                $this->A6 = 0;
                            } else {
                                $this->A6 = 1;
                            }
                            $resultpresence7 = $marksselection->A7;
                            if ($resultpresence7 == null) {
                                $this->A7 = 0;
                            } else {
                                $this->A7 = 1;
                            }
                            $resultpresence8 = $marksselection->A8;
                            if ($resultpresence8 == null) {
                                $this->A8 = 0;
                            } else {
                                $this->A8 = 1;
                            }
                            $resultpresence9 = $marksselection->A9;
                            if ($resultpresence9 == null) {
                                $this->A9 = 0;
                            } else {
                                $this->A9 = 1;
                            }
                            $resultpresence10 = $marksselection->A10;
                            if ($resultpresence10 == null) {
                                $this->A10 = 0;
                            } else {
                                $this->A10 = 1;
                            }
                            $resultsaverage = ($resultpresence1 + $resultpresence2 + $resultpresence3 + $resultpresence4 + $resultpresence5 + $resultpresence6 + $resultpresence7 + $resultpresence8 + $resultpresence9 + $resultpresence10) / ($this->A1 + $this->A2 + $this->A3 + $this->A4 + $this->A5 + $this->A6 + $this->A7 + $this->A8 + $this->A9 + $this->A10);
                            if ($resultsaverage >= 0.9 && $resultsaverage <= 1.49) {
                                $identifiers = 1;
                            }
                            if ($resultsaverage >= 1.5 && $resultsaverage <= 2.49) {
                                $identifiers = 2;
                            }
                            if ($resultsaverage >= 2.5 && $resultsaverage <= 3.0) {
                                $identifiers = 3;
                            }

                            $resultsupdate = MarksModel::find($marksselection->id);
                            $resultsupdate->Average = $resultsaverage;
                            $resultsupdate->Identifier = $identifiers;
                            $resultsupdate->Initials = $studentData['Initials'];
                            $resultsupdate->save();
                        }
                    }
                }

            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        response()->json([
            'statusCode' => 200,
            'message' => 'Records Saved Successsfully'
        ]);

    }
}

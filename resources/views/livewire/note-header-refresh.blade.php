 <li class="nav-item dropdown">
     <a class="nav-link" data-toggle="dropdown" href="#">
         <i class="far fa-bell"></i>
         <span class="badge badge-warning navbar-badge"> {{ $registeredNotifications->count() }}</span>
     </a>
     <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
         @foreach ($registeredNotifications as $registeredNotifications)
             <a href="#" class="dropdown-item">
                 <!-- Message Start-->
                 <div class="media">
                     <img src="{{ asset('dist/img/avatar5.png') }}" alt="User Avatar"
                         class="img-size-50 mr-3 img-circle">
                     <div class="media-body">
                         <h3 class="dropdown-item-title">
                             {{ $registeredNotifications->PostedBy }}
                             <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                         </h3>
                         <p class="text-sm">
                             {{ Str::limit(strip_tags($registeredNotifications->Description), 30, '...') }}</p>
                         <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> @php
                             date_default_timezone_set('Africa/Kampala');
                             $start = strtotime($registeredNotifications->created_at);
                             $end = strtotime(now());
                             $diffInseconds = $end - $start;
                             $diffinhours = round($diffInseconds / 60 / 60);
                             if ($diffinhours == 0 || $diffInseconds < 60) {
                                 $diffinmins = round($diffInseconds / 60);
                                 echo $diffinmins . ' Mins Ago';
                             } elseif ($diffInseconds < 60) {
                                 echo $diffInseconds . ' Secs Ago';
                             } elseif ($diffinhours > 24) {
                                 $diffindays = round($diffInseconds / 60 / 60 / 24);
                                 echo $diffindays . ' Days Ago';
                             } else {
                                 echo $diffinhours . ' Hrs Ago';
                             }

                         @endphp
                         </p>
                     </div>
                 </div>
                 <!-- Message End-->
             </a>
             <div class="dropdown-divider"></div>
         @endforeach

 </li>

 @push('scripts')
     <script>
         setInterval(function() {
             @this.call('pollnotifications');
         }, 2000); // Poll every 5 seconds (adjust the interval as needed)
     </script>
 @endpush

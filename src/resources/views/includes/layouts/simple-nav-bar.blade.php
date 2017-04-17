<div class="simple-nav-bar _fixed shadow" ng-controller="userViewCtrl">

   <nav class="navbar navbar-light {{ isset($full_width)?'navbar-full-width':'' }}">

      <button class="navbar-toggler hidden-md-up" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"></button>

      <div class="navbar-brand {{ !isset($isSearchOnMenu)?'flex-1':'' }}">
         <?php
            $logo = 'logo-text.png';
            if(isset($isSearchOnMenu))
               $logo = 'red-white.png';
         ?>
         <a href="{{ $baseUrlLang }}" title="">
            <img class="main-logo hidden-md-down" height="55px;" src="{{ asset('img/'.$logo) }}" alt="Hungry Hungry">
            <img class="main-logo hidden-lg-up" height="55px;" src="{{ asset('img/red-white.png') }}" alt="Hungry Hungry">
         </a>
         @include('includes.elements.comp.search-navbar', array('cls' => 'hidden-md-up'))
      </div>

      <div class="collapse navbar-toggleable-sm" id="navbarResponsive">

         <div class="{{ isset($isSearchOnMenu)?'display-flex flex-items-xs-middle':'' }}">

            @if(isset($isSearchOnMenu))
               @include('includes.elements.comp.search-navbar', array('cls' => 'hidden-sm-down'))
            @endif 

            <ul class="nav navbar-nav float-xs-right ">

               <li class="nav-item {{ Html::clever_link('contact-us') }} hidden-lg-down ">
                  <a class="nav-link" href="{{ $baseUrlLang.'/contact-us' }}">{{ trans('content.navbar.about_hungry_hungry') }}</a>
               </li>
               <li class="nav-item {{ Html::clever_link('contact-us') }} hidden-md-up ">
                  <a class="nav-link" href="{{ $baseUrlLang.'/contact-us' }}">{{ trans('content.navbar.about_hungry_hungry') }}</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="{{ $baseUrlLang.'/contact-us' }}">{{ trans('content.general.promotion') }}</a>
               </li>
               <li class="nav-item {{ Html::clever_link('map') }}">
                  <a class="nav-link" href="{{ $baseUrlLang.'/map' }}">{{ trans('content.navbar.place_on_map') }}</a>
               </li>
               <li class="nav-item hidden-xs-up">
                  <a class="nav-link" href="{{ $baseUrlLang.'/download-app' }}" ng-click="moveToEle('.download-app-section',false,1000)">{{ trans('content.navbar.download_app') }}</a>
               </li>
               <li class="nav-item hidden-sm-down">
                  <div class="nav-link"><span class="separator"></span></div>
               </li>

               @if(!AuthGateway::isLogin())

                  <li class="nav-item hidden-xl-down1">
                     <a class="nav-link nav-login btn btn-outline-primary hidden-sm-down" href="{{ $baseUrlLang.'/login' }}">{{ trans('content.navbar.log_in') }}</a>
                     <a class="nav-link nav-login hidden-md-up" style="padding-left: 0; margin: 0;" href="{{ $baseUrlLang.'/login' }}">{{ trans('content.navbar.log_in') }}</a>
                  </li>
                  <li class="nav-item hidden-sm-down">
                     <span class="nav-link _or"> {{ trans('content.navbar.or') }}</span>
                  </li>
                  <li class="nav-item hidden-xl-down1">
                     <a class="nav-link" href="{{ $baseUrlLang.'/signup' }}">{{ trans('content.navbar.sign_up') }}</a>
                  </li>

               @else

                  <li class="nav-item dropdown acc-profile 1hidden-xl-down">
                     <a class="nav-link dropdown-toggle" href="#" id="supportedContentDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        <?php

                           $profileImg = asset('img/tmp/user.png');

                           if(AuthGateway::user()['profile']){ 

                              if(isset(AuthGateway::user()['profile']['photo']))
                                 $profileImg = isset(AuthGateway::user()['profile']['photo']['thumbnail_url_link']) ? AuthGateway::user()['profile']['photo']['thumbnail_url_link'] : $profileImg;

                           }

                        ?>

                        <div class="img_logo bg-cover" ng-style="{ 'background-image' : 'url('+profilePhoto+')'}">
                           {{-- <img src="{{ $profileImg }}" alt="{{ AuthGateway::user()['profile']['full_name'] }}"> --}}
                        </div>

                        <span class="_name">{{ AuthGateway::user()['profile']['full_name'] }}</span>
                     </a>
                     <div class="dropdown-menu dropdown-menu-right account-dropwown" aria-labelledby="supportedContentDropdown">

                        <?php

                           $_userId = AuthGateway::user()['_id'];
                           $_userName = str_slug(AuthGateway::user()['profile']['full_name'],'-');


                        ?>

                        <a class="dropdown-item" href="{{ URL::action('UserController@userProfilePost',[$_userId,$_userName]) . '#/post'}} " ng-click="hhModule.controllMenu('#/post')">
                           {{ trans_choice('content.user.post',2) }}
                        </a>

                        <a class="dropdown-item" href="{{ URL::action('UserController@userProfilePost',[$_userId,$_userName]) . '#/photos'}}" ng-click="hhModule.controllMenu('#/photo')">{{ trans_choice('content.user.photo',2) }}</a>

                        <a class="dropdown-item" href="{{ URL::action('UserController@userProfilePost',[$_userId,$_userName]) . '#/saved'}}" ng-click="hhModule.controllMenu('#/save')">{{ trans_choice('content.user.save',2) }}</a>

                        <a class="dropdown-item" href="{{ URL::action('UserController@userProfilePost',[$_userId,$_userName]) . '#/setting'}}" ng-click="hhModule.controllMenu('#/setting')">{{ trans('content.user.setting') }}</a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ URL::action('HomeController@logout') }}" ng-click="logout()">{{ trans('content.user.log_out') }}</a>
                     </div>
                  </li>

               @endif

               <li class="nav-item hidden-sm-down">
                  <div class="nav-link"><span class="separator"></span></div>
               </li>

               @if(AuthGateway::isLogin())

                  <li class="nav-item dropdown acc-noti hidden-sm-down" >
                     <a class="nav-link dropdown-toggle" href="#" ng-click="setNotificationAsSeen()" id="supportedContentDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="icon-notifications"></span>
                        <span class="tag tag-pill tag-danger" ng-cloak ng-show="unseenCount>0"><% unseenCount %></span>
                     </a>
                     <div class="dropdown-menu dropdown-menu-right account-dropwown" aria-labelledby="supportedContentDropdown">

                        <div id="noti-container-list" class="noti-container-list" style="height: 350px">
                           {{-- @foreach(array('2','3','4','5','6') as $item) --}}
                           <a class="dropdown-item" ng-class="{'not-read-yet':!restItem.is_read}" style="display: block;" href="{{ $baseUrlLang }}/restaurant/<% hhModule.getRestDetail(restItem.reference_detail) + hhModule.getReadParam(restItem) %>" ng-repeat="(key, restItem) in notiList" ng-cloak>

                              <div class="media" ng-init="_img = hhModule.getRestCover(restItem);">
                                <div class="media-left bg-cover bg-gray-gark <% _img.bg_cls %>" style="background-image: url(<% restItem.reference_detail.cover.preview_url_link %>)">
                                  {{-- <img class="media-object" src="{{ asset('img/tmp/user.jpg') }}" alt="Generic placeholder image"> --}}
                                </div>
                                <div class="media-body">
                                  <h6 class="media-heading">
                                    <% restItem.text %>
                                    {{-- <% hhModule.getLangCate(restItem.reference_detail, 'directory_name') %> --}}
                                  </h6>
                                  {{-- Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque --}}
                                </div>
                                <span class="unseen-icon icon-fiber_manual_record" ng-hide="restItem.is_read"></span>
                              </div>

                           </a>
                           {{-- @endforeach --}}
                        </div>

                        <div class="text-xs-center load-more">
                           <button class="btn btn-primary btn-primary--fx btn-load-more bt-clear-style" ng-click="getNotification()" ng-class="{'btn-loading': isLoading}" ng-disabled="isLoading">
                              <span class="_text">{{ trans('content.general.load_more') }} ...</span>
                              <img class="center-absolute _loading-icon size-sm" src="{{ asset('img/svg/loading/loading-spin.svg') }}" alt="login loading">
                           </button>
                        </div>
                     </div>
                  </li>

               @endif

               <li class="nav-item lang clearfix-xs">
                 <?php  
                     $map_route= '';
                     if(isset($onMapSearch)){
                        $map_route = '<% map_route %>';
                     }
                  ?>
                  @if ($lang === 'en')
                     <a class="nav-link" href="{{ LaravelLocalization::getLocalizedURL('kh') }}">
                        <img class="flag" src="{{ asset('img/kh_icon.jpg') }}" alt="english language">
                        <span class="_text">KH</span>
                     </a>
                  @else
                     <a class="nav-link" href="{{ LaravelLocalization::getLocalizedURL('en') }}">
                        <img class="flag" src="{{ asset('img/en_icon.jpg') }}" alt="english language">
                        <span class="_text">EN</span>
                     </a>
                  @endif
               </li>

            </ul>

         </div>
      </div>
   </nav>
</div>
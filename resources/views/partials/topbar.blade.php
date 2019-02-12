<div class="topbar-header">
	<div class="container-fluid d-none d-md-block d-lg-block d-xl-block">
		<div class="mega-link row align-items-center">
			<div class="col-2">
				<div class="row justify-content-center">
					<a class="logo" href="{{ URL::to('/') }}"><img class="img-fluid mx-auto d-block" src="{{ URL::asset('img/logo.png') }}"/></a>
				</div>
			</div>
			<div class="col-6">
				<nav class="row navbar navbar-expand-lg navbar-light">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
					</button>

					<div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
						<ul class="navbar-nav">
							@foreach($nav as $n)
								@if($n->navType==\App\Engine\Menu\MenuItem::$NAV_TYPE_NAV)
									<li class="nav-item {{ $n->icon }}@if($n->isActive) is-active @endif">
										<a class="nav-link link-item p-4" href="{{ route($n->routeName) }}"><span>{{ $n->label }}</span></a>
									</li>
								@endif
							@endforeach
						</ul>
						
					</div>
				
				</nav>
			</div>
			<div class="col-4">
			<form id="form-search-md" method="get" class="collapse col-10 no-gutters" action="{{ route($routeSearch->routeName) }} ">
				@csrf
				<div class="row">
					<div class="input-group w-100">
						<input class="form-control py-2 border" placeholder="@lang('app.place_holder_search')" type="search" value="{{ @$keyword }}" id="search-input">
					</div>
				</div>
			</form>
            <div class="row align-items-center">
                <div class="col-2">
                    <div class="row">
                        <span class="input-group-append">
                            <button class="btn btn-search-submit btn-outline-custom border-left-0" data-target="#form-search-md" data-toggle="collapse" data-target="">
                                <i class="fa fa-search"></i>
                            </button>
                          </span>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="dropdown languages">
                            <button class="btn btn-flag dropdown-toggle" type="button" id="btnDropdownLanguages" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="circle {{ $currentLanguage->icon }}"></span> {{ $currentLanguage->label }}
                            </button>
                            <div class="dropdown-menu" aria-labelledby="btnDropdownLanguages">
                            @foreach ($langs as $lang)
                                @if ($currentLanguage !== $lang)
                                <a class="dropdown-item" href="{{ $lang->routeName }}">{{ $lang->label }}</a>
                                @endif
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-5">
                    <div class="row">
                        <div class="social-icons">
                            <a href="https://www.facebook.com/totwork/" target="_blank" class="d-inline"><i class="circle fa fa-facebook"></i></a>
                            <a href="#" class="d-inline"><i class="circle fa fa-twitter"></i></a>
                            <a href="#" class="d-inline"><i class="circle fa fa-google-plus"></i></a>
                            <a href="#" class="d-inline"><i class="circle fa fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
           </div>
		</div>
	</div>
    <div class="container-fluid d-none d-block d-sm-block d-md-none">
		
        <div class="row align-items-center">
			<div class="col">
                <div class="row justify-content-start">
                    <div class="social-icons d-inline-flex">
						<a class="logo" href="{{ URL::to('/') }}"><img class="img-fluid mx-auto d-block" src="{{ URL::asset('img/logo.png') }}"/></a>
                        <!--<a href="#" class="d-block"><i class="circle fa fa-facebook"></i></a>
                        <a href="#" class="d-block"><i class="circle fa fa-twitter"></i></a>
                        <a href="#" class="d-block"><i class="circle fa fa-google-plus"></i></a>
                        <a href="#" class="d-block"><i class="circle fa fa-instagram"></i></a>-->
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row justify-content-end">
						
                    <div class="dropdown languages">
                        <button class="btn btn-flag dropdown-toggle" type="button" id="btnDropdownLanguages" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="circle {{ $currentLanguage->icon }}"></span> {{ $currentLanguage->label }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnDropdownLanguages">
                        @foreach ($langs as $lang)
                            @if ($currentLanguage !== $lang)
                            <a class="dropdown-item" href="{{ $lang->routeName }}">{{ $lang->label }}</a>
                            @endif
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row align-items-center">
              <nav class="w-100 pl-0 pr-0 navbar navbar-expand-lg navbar-light sm">
					
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-sm" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
					</button>
                  <form method="get" class="" action="{{ route($routeSearch->routeName) }} ">
                    @csrf
                    <div class="row">
                        <div class="input-group col-md-4">
                            <input class="form-control py-2 border-right-0 border" placeholder="Search" type="search" value="{{ @$keyword }}" id="search-input">
                            <span class="input-group-append">
                                <button class="btn btn-outline-custom border-left-0 border" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                              </span>
                        </div>
                    </div>
                </form>
					<div class="collapse navbar-collapse navbar-sm" id="navbar-sm">
						<ul class="navbar-nav mr-auto">
							@foreach($nav as $n)
								@if($n->navType==\App\Engine\Menu\MenuItem::$NAV_TYPE_NAV)
									<li class="nav-item {{ $n->icon }}@if($n->isActive) is-active @endif">
										<a class="nav-link link-item p-4" href="{{ route($n->routeName) }}"><span>{{ $n->label }}</span></a>
									</li>
								@endif
							@endforeach
						</ul>
						
					</div>
				
				</nav>
        </div>
    </div>
</div>
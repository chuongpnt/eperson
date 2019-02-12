<div class="topbar-header">
	<div class="container-fluid">
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

					<div class="collapse navbar-collapse" id="navbarSupportedContent">
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
			<div class="col-4">
            <div class="row align-items-center">
                <div class="col-2">
                    <div class="row">

                        <form  method="get" class="" action="{{ route($routeSearch->routeName) }} ">
                            @csrf
                            <input type="search" class="search-field" placeholder="Enter search terms…" value="{{ @$keyword }}" name="s" title="Search for">
                            <button type="submit"><i class="fa fa-search"></i></button>

                        </form>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="dropdown">
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
                            <a href="#" class="d-inline"><i class="circle fa fa-facebook"></i></a>
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
</div>
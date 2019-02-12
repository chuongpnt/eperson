@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">
			<li>
				<a href="{{ url('/') }}">
					<i class="fa fa-eye"></i>
					<span class="title">@lang('quickadmin.qa_visit_site')</span>
				</a>
			</li>
			@foreach($nav as $n)
				@if($n->navType==\App\Engine\Menu\MenuItem::$NAV_TYPE_NAV)
					<li class="treeview {{$n->class}}">
						@if($n->navMenu)
						<a href="{{ $n->routeName }}">
							<i class="{{ $n->icon }}"></i>
							<span class="title">{{ $n->label }}</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							@foreach($n->navMenu as $tv)
                            @if($tv->navType==\App\Engine\Menu\MenuItem::$NAV_TYPE_NAV)
                            <li>
                                <router-link :to='{ name: "{{ $tv->routeName }}" }'>
                                    <i class="{{ $tv->icon }}"></i>
                                    <span class="title">{{ $tv->label }}</span>
                                </router-link>
                            </li>
                            @endif
							@endforeach
						</ul>
						@else
							<router-link :to="{ name: '{{ $n->routeName }}' }">
								<i class="{{ $n->icon }}"></i>
								<span class="title">{{ $n->label }}</span>
							</router-link>
						@endif
					</li>
				@endif
			@endforeach
			<li>
				<a href="#logout" onclick="$('#logout').submit();">
					<i class="fa fa-arrow-left"></i>
					<span class="title">@lang('quickadmin.qa_logout')</span>
				</a>
			</li>
        </ul>
    </section>
</aside>

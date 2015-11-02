<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

    <div class="menu_section">
        <h3>Navigation</h3>
        <ul class="nav side-menu">
            @foreach(config('admintemplate.side_links') as $category)
                <li>
                    <a @if(!isset($category['child'])) href=" {{ URL::to($category['url']) }}"@endif>
                        <i class="fa {{ $category['icon'] }}"></i> {{ $category['name'] }}

                        @if(isset($category['child'])) <span class="fa fa-chevron-down"></span> @endif
                    </a>
                    @if(isset($category['child']))
                        <ul class="nav child_menu" style="display: none">
                            @foreach($category['child'] as $child)
                                <li><a href="{{ URL::to($child['url']) }}">{{ $child['name'] }}</a></li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>

</div>
<!-- /sidebar menu -->

<!-- /menu footer buttons -->
<div class="sidebar-footer hidden-small">
    <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Lock">
        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Logout">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
    </a>
</div>
<!-- /menu footer buttons -->
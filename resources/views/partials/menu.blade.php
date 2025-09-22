<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li>
            <select class="searchable-field form-control">

            </select>
        </li>
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }} {{ request()->is("admin/teams*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('team_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.teams.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/teams") || request()->is("admin/teams/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.team.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('projektleitung_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/tebex-lizenzens*") ? "c-show" : "" }} {{ request()->is("admin/items*") ? "c-show" : "" }} {{ request()->is("admin/fahrzeuges*") ? "c-show" : "" }} {{ request()->is("admin/werkbankes*") ? "c-show" : "" }} {{ request()->is("admin/shops*") ? "c-show" : "" }} {{ request()->is("admin/kategoriens*") ? "c-show" : "" }} {{ request()->is("admin/audit-logs*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.projektleitung.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('tebex_lizenzen_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tebex-lizenzens.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tebex-lizenzens") || request()->is("admin/tebex-lizenzens/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.tebexLizenzen.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('item_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.items.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/items") || request()->is("admin/items/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.item.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('fahrzeuge_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.fahrzeuges.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/fahrzeuges") || request()->is("admin/fahrzeuges/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.fahrzeuge.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('werkbanke_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.werkbankes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/werkbankes") || request()->is("admin/werkbankes/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.werkbanke.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('shop_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.shops.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/shops") || request()->is("admin/shops/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.shop.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('kategorien_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.kategoriens.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/kategoriens") || request()->is("admin/kategoriens/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.kategorien.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('audit_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.audit-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.auditLog.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('supporter_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/supports*") ? "c-show" : "" }} {{ request()->is("admin/datenbanks*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-headset c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.supporter.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('support_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.supports.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/supports") || request()->is("admin/supports/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-folder-open c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.support.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('datenbank_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.datenbanks.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/datenbanks") || request()->is("admin/datenbanks/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-hdd c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.datenbank.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @if(\Illuminate\Support\Facades\Schema::hasColumn('teams', 'owner_id') && \App\Models\Team::where('owner_id', auth()->user()->id)->exists())
            <li class="c-sidebar-nav-item">
                <a class="{{ request()->is("admin/team-members") || request()->is("admin/team-members/*") ? "c-active" : "" }} c-sidebar-nav-link" href="{{ route("admin.team-members.index") }}">
                    <i class="c-sidebar-nav-icon fa-fw fa fa-users">
                    </i>
                    <span>{{ trans("global.team-members") }}</span>
                </a>
            </li>
        @endif
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>
<div id="rightbar" class="rightbar">
    <div class="body">
        <ul class="nav nav-tabs2">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#Chat-one">{{ __('Cold Chambers') }}</a></li>
        </ul>
        <hr>
        <div class="tab-content">

            <aside-cold-chamber-list coldchambersprop="{{ $coldChambers }}" url="{{ route('cold_chamber.current.temperature') }}"></aside-cold-chamber-list>

{{--            <div class="tab-pane vvivify fadeIn delay-100" id="Chat-list">--}}
{{--                <ul class="right_chat list-unstyled mb-0">--}}
{{--                    <li class="offline">--}}
{{--                        <a href="javascript:void(0);">--}}
{{--                            <div class="media">--}}
{{--                                <div class="avtar-pic w35 bg-red"><span>FC</span></div>--}}
{{--                                <div class="media-body">--}}
{{--                                    <span class="name">Folisise Chosielie</span>--}}
{{--                                    <span class="message">offline</span>--}}
{{--                                    <span class="badge badge-outline status"></span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="online">--}}
{{--                        <a href="javascript:void(0);">--}}
{{--                            <div class="media">--}}
{{--                                <img class="media-object " alt="" src="{{ asset('assets/core/images/xs/avatar3.jpg') }}">--}}
{{--                                <div class="media-body">--}}
{{--                                    <span class="name">Marshall Nichols</span>--}}
{{--                                    <span class="message">online</span>--}}
{{--                                    <span class="badge badge-outline status"></span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="online">--}}
{{--                        <a href="javascript:void(0);">--}}
{{--                            <div class="media">--}}
{{--                                <div class="avtar-pic w35 bg-red"><span>FC</span></div>--}}
{{--                                <div class="media-body">--}}
{{--                                    <span class="name">Louis Henry</span>--}}
{{--                                    <span class="message">online</span>--}}
{{--                                    <span class="badge badge-outline status"></span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="online">--}}
{{--                        <a href="javascript:void(0);">--}}
{{--                            <div class="media">--}}
{{--                                <div class="avtar-pic w35 bg-orange"><span>DS</span></div>--}}
{{--                                <div class="media-body">--}}
{{--                                    <span class="name">Debra Stewart</span>--}}
{{--                                    <span class="message">online</span>--}}
{{--                                    <span class="badge badge-outline status"></span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="offline">--}}
{{--                        <a href="javascript:void(0);">--}}
{{--                            <div class="media">--}}
{{--                                <div class="avtar-pic w35 bg-green"><span>SW</span></div>--}}
{{--                                <div class="media-body">--}}
{{--                                    <span class="name">Lisa Garett</span>--}}
{{--                                    <span class="message">offline since May 12</span>--}}
{{--                                    <span class="badge badge-outline status"></span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="online">--}}
{{--                        <a href="javascript:void(0);">--}}
{{--                            <div class="media">--}}
{{--                                <img class="media-object " alt="" src="{{ asset('assets/core/images/xs/avatar5.jpg') }}">--}}
{{--                                <div class="media-body">--}}
{{--                                    <span class="name">Debra Stewart</span>--}}
{{--                                    <span class="message">online</span>--}}
{{--                                    <span class="badge badge-outline status"></span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="offline">--}}
{{--                        <a href="javascript:void(0);">--}}
{{--                            <div class="media">--}}
{{--                                <img class="media-object " alt="" src="{{ asset('assets/core/images/xs/avatar2.jpg') }}">--}}
{{--                                <div class="media-body">--}}
{{--                                    <span class="name">Lisa Garett</span>--}}
{{--                                    <span class="message">offline since Jan 18</span>--}}
{{--                                    <span class="badge badge-outline status"></span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="online">--}}
{{--                        <a href="javascript:void(0);">--}}
{{--                            <div class="media">--}}
{{--                                <div class="avtar-pic w35 bg-indigo"><span>FC</span></div>--}}
{{--                                <div class="media-body">--}}
{{--                                    <span class="name">Louis Henry</span>--}}
{{--                                    <span class="message">online</span>--}}
{{--                                    <span class="badge badge-outline status"></span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="online">--}}
{{--                        <a href="javascript:void(0);">--}}
{{--                            <div class="media">--}}
{{--                                <div class="avtar-pic w35 bg-pink"><span>DS</span></div>--}}
{{--                                <div class="media-body">--}}
{{--                                    <span class="name">Debra Stewart</span>--}}
{{--                                    <span class="message">online</span>--}}
{{--                                    <span class="badge badge-outline status"></span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="offline">--}}
{{--                        <a href="javascript:void(0);">--}}
{{--                            <div class="media">--}}
{{--                                <div class="avtar-pic w35 bg-info"><span>SW</span></div>--}}
{{--                                <div class="media-body">--}}
{{--                                    <span class="name">Lisa Garett</span>--}}
{{--                                    <span class="message">offline since May 12</span>--}}
{{--                                    <span class="badge badge-outline status"></span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--            <div class="tab-pane vivify fadeIn delay-100" id="Chat-groups">--}}
{{--                <ul class="right_chat list-unstyled mb-0">--}}
{{--                    <li class="offline">--}}
{{--                        <a href="javascript:void(0);">--}}
{{--                            <div class="media">--}}
{{--                                <div class="avtar-pic w35 bg-cyan"><span>DT</span></div>--}}
{{--                                <div class="media-body">--}}
{{--                                    <span class="name">Designer Team</span>--}}
{{--                                    <span class="message">offline</span>--}}
{{--                                    <span class="badge badge-outline status"></span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="online">--}}
{{--                        <a href="javascript:void(0);">--}}
{{--                            <div class="media">--}}
{{--                                <div class="avtar-pic w35 bg-azura"><span>SG</span></div>--}}
{{--                                <div class="media-body">--}}
{{--                                    <span class="name">Sale Groups</span>--}}
{{--                                    <span class="message">online</span>--}}
{{--                                    <span class="badge badge-outline status"></span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="online">--}}
{{--                        <a href="javascript:void(0);">--}}
{{--                            <div class="media">--}}
{{--                                <div class="avtar-pic w35 bg-orange"><span>NF</span></div>--}}
{{--                                <div class="media-body">--}}
{{--                                    <span class="name">New Fresher</span>--}}
{{--                                    <span class="message">online</span>--}}
{{--                                    <span class="badge badge-outline status"></span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="offline">--}}
{{--                        <a href="javascript:void(0);">--}}
{{--                            <div class="media">--}}
{{--                                <div class="avtar-pic w35 bg-indigo"><span>PL</span></div>--}}
{{--                                <div class="media-body">--}}
{{--                                    <span class="name">Project Lead</span>--}}
{{--                                    <span class="message">offline since May 12</span>--}}
{{--                                    <span class="badge badge-outline status"></span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
        </div>
    </div>
</div>

<aside class="sm-side">
    @if (Auth::check())
        <div class="user-head">
            <div class="user-name">
                <h5><a href="#">{{ Auth::user()->name }}</a></h5>
                <span><a href="#">{{ Auth::user()->email }}</a></span>
            </div>
        </div>
    @endif
    @if (!Auth::check())
        <div class="user-head">
            <div class="user-name">
                <h5><a href="#">Welcome To Chat Application</a></h5>
                <span><a href="#">Create Account To Go in</a></span>
            </div>
        </div>
    @endif
    {{-- <div class="inbox-body">
        <a href="#myModal" data-toggle="modal"  title="Compose"    class="btn btn-compose">
            Compose
        </a>
        <!-- Modal -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                        <h4 class="modal-title">Compose</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-lg-2 control-label">To</label>
                                <div class="col-lg-10">
                                    <input type="text" placeholder="" id="inputEmail1" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Cc / Bcc</label>
                                <div class="col-lg-10">
                                    <input type="text" placeholder="" id="cc" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Subject</label>
                                <div class="col-lg-10">
                                    <input type="text" placeholder="" id="inputPassword1" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Message</label>
                                <div class="col-lg-10">
                                    <textarea rows="10" cols="30" class="form-control" id="" name=""></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <span class="btn green fileinput-button">
                                        <i class="fa fa-plus fa fa-white"></i>
                                        <span>Attachment</span>
                                        <input type="file" name="files[]" multiple="">
                                    </span>
                                    <button class="btn btn-send" type="submit">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div> --}}
    <br><br>
    <ul class="inbox-nav inbox-divider">
        @if (Auth::check())
            <li>
                <a v-link="{path: '/AddRooms'}"><i class="fa fa-plus-circle"></i> Add Room</a>
            </li>
            <li>
                <a v-link="{path: '/MyRooms'}"><i class="fa fa-user"></i> My Rooms</a>
            </li>
            <li>
                <a v-link="{path: '/AllRooms'}"><i class="fa fa-users"></i> All Rooms</a>
            </li>
        @else
            <li>
                <a href="{{ url('/') }}"><i class="fa fa-check-square-o"></i> Welcome</a>
            </li>
            <li class="">
                <a href="{{ url('/login') }}"><i class="fa fa-search"></i> login</a>
            </li>
            <li class="">
                <a href="{{ url('/register') }}"><i class="fa fa-search-plus"></i> register</a>
            </li>
        @endif
    </ul>
    @if (Auth::check())
        <ul class="inbox-nav inbox-divider">
            <li class="">
                <a href="{{ url('/logout') }}"><i class="fa fa-share"></i> logout</a>
            </li>
        </ul>
    @endif
</aside>

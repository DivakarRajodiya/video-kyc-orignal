{{--<div class="footer-left">--}}
{{--    All rights reserved &copy; {{ date('Y') }}--}}
{{--</div>--}}
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; LiveSmart Video Chat 2019-{{ date('Y') }}</span>
        </div>
    </div>
</footer>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" data-localize="ready_leave"></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" data-localize="select_logout"></div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal" data-localize="cancel"></button>
                <a class="btn btn-primary" href="#" data-localize="logout"></a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="generateBroadcastLinkModal" tabindex="-1" role="dialog" aria-labelledby="generateBroadcastLinkModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" data-localize="broadcasting_attendee_url"></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" data-localize="broadcasting_attendee_info"></div>
            <div class="modal-footer">
                <button class="btn btn-primary mr-auto" type="button" id="copyBroadcastUrl" data-localize="copy_url"></button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal" data-localize="close"></button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="generateLinkModal" tabindex="-1" role="dialog" aria-labelledby="generateLinkModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" data-localize="video_attendee_url"></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" data-localize="video_attendee_info"></div>
            <div class="modal-footer">
                <button class="btn btn-primary mr-auto" type="button" id="copyAttendeeUrl" data-localize="copy_url"></button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal" data-localize="close"></button>
            </div>
        </div>
    </div>
</div>

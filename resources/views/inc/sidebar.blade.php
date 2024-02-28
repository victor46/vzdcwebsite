<div class="card bg-light card-body" id="pill-sidebar">
    <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical" style="margin-left:20px;">
        <div class="dropdown-divider"></div>
        <p class="collapsible-controllers" style="margin-left:-20px; cursor:pointer">
            ZDC CONTROLLERS
            <b id="caret-controllers" class="float-right fas fa-caret-left"></b>
        </p>
        <div class="content">
            @if(Auth::user()->rating_id >= 1)
                <a class="nav-link {{ Nav::urlDoesContain('dashboard/controllers/teamspeak') }}"
                   href="/dashboard/controllers/teamspeak">Teamspeak Information</a>
            @endif
            <a class="nav-link" href="https://discord.gg/me9zury" target="_blank">ZDC Discord</a>
            <a class="nav-link {{ Nav::urlDoesContain('dashboard/controllers/roster') }} {{ Nav::urlDoesContain('/dashboard/admin/roster') }}"
               href="/dashboard/controllers/roster">Roster</a>
            <a class="nav-link {{ Nav::urlDoesContain('dashboard/controllers/events') }} {{ Nav::urlDoesContain('dashboard/admin/events') }}"
               href="/dashboard/controllers/events">Events</a>
            <a class="nav-link {{ Nav::urlDoesContain('dashboard/controllers/files') }} {{ Nav::urlDoesContain('dashboard/admin/files') }}"
               href="/dashboard/controllers/files">Files</a>
            <a class="nav-link {{ Nav::urlDoesContain('dashboard/controllers/scenery') }}"
               href="/dashboard/controllers/scenery">Scenery</a>
            <a class="nav-link {{ Nav::urlDoesContain('dashboard/controllers/stats') }}"
               href="/dashboard/controllers/stats">Statistics</a>
            <a class="nav-link {{ Nav::urlDoesContain('dashboard/controllers/incident/report') }}"
               href="/dashboard/controllers/incident/report">Incident Report</a>
            <a class="nav-link {{ Nav::urlDoesContain('dashboard/controllers/currency_hours') }}"
               href="/dashboard/controllers/currency_hours">Currency Hours</a>
               <a class="nav-link {{ Nav::urlDoesContain('dashboard/controllers/loa/request') }}"
               href="/dashboard/controllers/loa/request">LOA Request</a>
            <a class="nav-link" href="https://ids.vzdc.org" target="_top">
               ZDC IDS</a>
            <div class="dropdown-divider"></div>
            <a class="nav-link {{ Nav::urlDoesContain('/dashboard/controllers/profile') }} {{ Nav::urlDoesContain('/dashboard/controllers/ticket') }}"
               href="/dashboard/controllers/profile"><i class="fas fa-user"></i> My Profile</a>
            <a class="nav-link" href="/"><i class="fas fa-arrow-circle-left"></i> Return to Main Website</a>
            <a class="nav-link" href="/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
        @if(Auth::user()->canTrain == 1 || Auth::user()->can('train'))
            <div class="dropdown-divider"></div>
            <p class="collapsible-train" style="margin-left:-20px; cursor:pointer">
                TRAINING
                <b id="caret-train" class="float-right fas fa-caret-left"></b>
            </p>
            <div class="content">
                <a class="btn btn-secondary btn-block"
                   href="https://training.vzdc.org">Schedule a Training
                    Session</a>
                <a class="nav-link {{ Nav::urlDoesContain('/dashboard/training/atcast') }}"
                   href="/dashboard/training/atcast">ATCast Videos</a>
                @if(Auth::user()->can('train'))
                    <a class="nav-link {{ Nav::urlDoesContain('dashboard/training/files') }}"
                       href="/dashboard/training/info">Training Information</a>
                    <a class="nav-link {{ Nav::urlDoesContain('dashboard/training/tickets') }}"
                       href="/dashboard/training/tickets">Training Tickets</a>
                    <a class="nav-link" href="https://training.vzdc.org" target="_blank">Schedule Management</a>
                    @if(Auth::user()->hasRole('ins') || Auth::user()->can('snrStaff'))
                        <a class="nav-link {{ Nav::urlDoesContain('dashboard/training/ots-center') }}"
                           href="/dashboard/training/ots-center">OTS Center</a>
                    @endif
                    @if(Auth::user()->hasRole('ins') || Auth::user()->can('snrStaff'))
                        <a class="nav-link {{ Nav::urlDoesContain('dashboard/training/feedback') }}"
                            href="/dashboard/training/feedback">Feedback</a>
                    @endif
                @endif
            </div>
        @else
            <div class="dropdown-divider"></div>
            <p class="collapsible-train" style="margin-left:-20px; cursor:pointer">
                TRAINING
                <b id="caret-train" class="float-right fas fa-caret-left"></b>
            </p>
            <div class="content">
                <font size="2" color="red"><b>*You are not authorized to schedule training. Please contact the TA for
                        more info*</b></font>
            </div>
        @endif
        @if(Auth::user()->can('staff') || Auth::user()->can('email') || Auth::user()->can('scenery') || Auth::user()->can('files') || Auth::user()->can('events'))
            <div class="dropdown-divider"></div>
            <p class="collapsible-admin" style="margin-left:-20px; cursor:pointer">
                ADMINISTRATION
                <b id="caret-admin" class="float-right fas fa-caret-left"></b>
            </p>
            <div class="content">
                @if(Auth::user()->can('staff'))
                    <a class="nav-link {{ Nav::urlDoesContain('dashboard/admin/airports') }}"
                       href="/dashboard/admin/airports">Airport Management</a>
                    <a class="nav-link {{ Nav::urlDoesContain('dashboard/admin/announcement') }}"
                       href="/dashboard/admin/announcement">Announcement</a>
                @endif
                @if(Auth::user()->can('roster'))
                    <a class="nav-link {{ Nav::urlDoesContain('dashboard/admin/bronze-mic') }}"
                       href="/dashboard/admin/bronze-mic">Bronze Mic Management</a>
                @endif
                @if(Auth::user()->can('staff'))
                    <a class="nav-link {{ Nav::urlDoesContain('dashboard/admin/calendar') }}"
                       href="/dashboard/admin/calendar">Calendar/News</a>
                    <a class="nav-link {{ Nav::urlDoesContain('dashboard/admin/dossier') }}"
                       href="/dashboard/admin/dossier">Dossier Entries</a>
                @endif
                @if(Auth::user()->can('email'))
                    <a class="nav-link" href="https://mail.vzdc.org" target="_blank">Email</a>
                @endif
                @if(Auth::user()->can('snrStaff'))
                    <a class="nav-link {{ Nav::urlDoesContain('dashboard/admin/feedback') }}"
                       href="/dashboard/admin/feedback">Feedback Management</a>
                    <a class="nav-link {{ Nav::urlDoesContain('dashboard/admin/incident') }}"
                       href="/dashboard/admin/incident">Incident Report Management</a>
                @endif
                @if(Auth::user()->can('scenery'))
                    <a class="nav-link {{ Nav::urlDoesContain('dashboard/admin/scenery') }}"
                       href="/dashboard/admin/scenery">Scenery Management</a>
                @endif
                @if(Auth::user()->can('email'))
                    <a class="nav-link {{ Nav::urlDoesContain('dashboard/admin/email/send') }}"
                       href="/dashboard/admin/email/send">Send New/Mass Email</a>
                @endif
                @if(Auth::user()->can('snrStaff'))
                    <a class="nav-link {{ Nav::urlDoesContain('dashboard/admin/loas') }}"
                       href="/dashboard/admin/loas">LOA Center</a>
                @endif
                @if(Auth::user()->can('snrStaff'))
                    <a class="nav-link {{ Nav::urlDoesContain('dashboard/admin/audits') }}"
                       href="/dashboard/admin/audits">Website Activity</a>
                @endif
                @if(Auth::user()->can('snrStaff'))
                    <a class="nav-link {{ Nav::urlDoesContain('dashboard/admin/variables') }}"
                       href="/dashboard/admin/variables">Website Variables</a>
                @endif
            </div>
        @endif
        <div class="dropdown-divider"></div>
    </div>
</div>

<style>
    .collapsible {
        cursor: pointer;
    }

    .content {
        text-align: left;
        overflow: hidden;
        min-height: 0;
        max-height: 0;
        transition: max-height 0.5s ease-out;
    }

    .open {
        transform: rotate(-90deg);
    }

</style>
<br>
<iframe src="https://discordapp.com/widget?id=391802941486530561&theme=light" width="285" height="600"
        allowtransparency="true" frameborder="0"></iframe>
<script>
    var coll = document.getElementsByClassName("collapsible-controllers");
    var i;
    var iconc = document.getElementById("caret-controllers");

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function () {
            iconc.classList.toggle('open');
            this.classList.toggle("active");
            var content = this.nextElementSibling;

            if (content.style.maxHeight) {
                content.style.maxHeight = null;
            } else {
                content.style.maxHeight = content.scrollHeight + "px";
            }
        });

        for (i = 0; i < coll.length; i++) {
            if (coll[i].nextElementSibling.innerHTML.indexOf("active") !== -1) {
                coll[i].click();
            }
        }
    }

    var coll = document.getElementsByClassName("collapsible-train");
    var i;
    var icont = document.getElementById("caret-train");

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function () {
            icont.classList.toggle('open');
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.maxHeight) {
                content.style.maxHeight = null;
            } else {
                content.style.maxHeight = content.scrollHeight + "px";
            }
        });

        for (i = 0; i < coll.length; i++) {
            if (coll[i].nextElementSibling.innerHTML.indexOf("active") !== -1) {
                coll[i].click();
            }
        }
    }

    var coll = document.getElementsByClassName("collapsible-admin");
    var i;
    var icona = document.getElementById("caret-admin");

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function () {
            icona.classList.toggle('open');
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.maxHeight) {
                content.style.maxHeight = null;
            } else {
                content.style.maxHeight = content.scrollHeight + "px";
            }
        });

        for (i = 0; i < coll.length; i++) {
            if (coll[i].nextElementSibling.innerHTML.indexOf("active") !== -1) {
                coll[i].click();
            }
        }
    }
</script>


<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<meta name="robots" content="noindex, nofollow">

<meta name="csrf-token" content="47QQOXKs0tTu0F5McrsKQXH73KLrDIyO59a6WLlw"/> 
<title>Login :: Globaldrinkshub Admin Panel</title>


<script>document.documentElement.setAttribute("data-bs-theme", localStorage.colorMode ?? 'light');</script>

<link href="https://unpkg.com/@tabler/core@1.0.0-beta19/dist/css/tabler.min.css?6cf201c6ede4" rel="stylesheet" type="text/css" />
<link href="/storage/basset/vendor/backpack/theme-tabler/resources/assets/css/style.css?6cf201c6ede4" rel="stylesheet" type="text/css" />
<link href="https://unpkg.com/animate.css@4.1.1/animate.compat.css?6cf201c6ede4" rel="stylesheet" type="text/css" />
<link href="https://unpkg.com/noty@3.2.0-beta-deprecated/lib/noty.css?6cf201c6ede4" rel="stylesheet" type="text/css" />

<link href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css?6cf201c6ede4" rel="stylesheet" type="text/css" />

<link href="/storage/basset/vendor/backpack/crud/src/resources/assets/css/common.css?6cf201c6ede4" rel="stylesheet" type="text/css" />

                        <link href="/storage/basset/vendor/backpack/theme-tabler/resources/assets/css/color-adjustments.css?6cf201c6ede4" rel="stylesheet" type="text/css" />
                                <link href="/storage/basset/vendor/backpack/theme-tabler/resources/assets/css/colors.css?6cf201c6ede4" rel="stylesheet" type="text/css" />
            


    <style>
        footer {
            width: 100%;
            position: fixed;
            bottom: 0;
            background-color: transparent !important;
            border: none !important;
        }
        .switch-mode {
            position: absolute;
            top: 0;
            right: 0;
            z-index: 999;
        }
    </style>
</head>

<body class=" ">

<script>
    class ColorMode {
        constructor(states, defaultColorMode) {
            this.value = null;
            this.valueSystem = null;
            this.listeners = [];
            this.states = states;

            this.set(window.localStorage.getItem('colorMode') ?? defaultColorMode);

            // listen for color scheme changes
            const query = window.matchMedia('(prefers-color-scheme: dark)');
            query.addEventListener('change', e => this.onColorSchemeChange(e));
            this.onColorSchemeChange(query);
        }

        set(theme = 'system', fromSystemChange = false) {
            // clear previous theme attributes
            window.localStorage.removeItem('colorMode');
            document.documentElement.removeAttribute('data-theme');
            document.documentElement.removeAttribute('data-bs-theme');
            document.body.className = document.body.className.replace(/theme-\w+/, '').trim();

            // store changes if not from color scheme changes
            if(!fromSystemChange) {
                this.value = theme;

                if(theme !== 'system') {
                    window.localStorage.setItem('colorMode', theme);
                    document.documentElement.dataset.theme = theme;
                }
            }

            if(theme === 'system') theme = this.valueSystem;

            document.documentElement.dataset.bsTheme = theme;
            document.body.classList.add(`theme-${theme}`);

            this.listeners.forEach(listener => listener && listener(this.result));
        }

        get() {
            return this.value;
        }

        get result() {
            return this.value === 'system' ? this.valueSystem : this.value;
        }

        onColorSchemeChange(query) {
            this.valueSystem = query.matches ? 'dark' : 'light';
            if(this.value === 'system') this.set(this.valueSystem, true);
        }

        switch() {
            let current = this.states.indexOf(this.value);
            let next = current + 1 >= this.states.length ? 0 : current + 1;

            this.set(this.states[next]);
        }

        onChange(callback) {
            return this.listeners.push(callback);
        }

        offChange(reference) {
            this.listeners[reference - 1] = null;
        }
    }

    window.colorMode = new ColorMode(
        // color modes list
        ["light","system","dark"],

        // default color mode
        "dark"    );
</script>

    <div class="page page-center">
        <div class="container container-normal py-4">
            <div class="row align-items-center g-4">
                <div class="col-lg">
                    <div class="container-tight">
                        <div class="text-center mb-4 display-6 auth-logo-container">
                            <b>GlobalDrinks</b>HUB
                            {{Auth::check()}}
                        </div>
                        <div class="card card-md">
                            <div class="card-body pt-0">
                                <h2 class="h2 text-center my-4">Login</h2>
<form method="POST" action="{{route('panel/login_auth')}}" autocomplete="off" novalidate="">
    @csrf   
    <div class="mb-3">
        <label class="form-label" for="email">Email</label>
        <input autofocus tabindex="1" type="text" name="email" value="" id="email" class="form-control ">
            </div>
    <div class="mb-2">
        <label class="form-label" for="password">
            Password
        </label>
        <div class="input-group input-group-flat password-visibility-toggler">
            <input tabindex="2" type="password" name="password" id="password" class="form-control " value="">
                    </div>
            </div>
    <div class="d-flex justify-content-between align-items-center mb-2">
        <label class="form-check mb-0">
            <input name="remember" tabindex="3" type="checkbox" class="form-check-input">
            <span class="form-check-label">Remember me</span>
        </label>
                    <div class="form-label-description">
                <a tabindex="4" href="https://admin.globaldrinkshub.com/panel/password/reset">Forgot Your Password?</a>
            </div>
            </div>
    <div class="form-footer">
        <button tabindex="5" type="submit" class="btn btn-primary w-100">Login</button>
    </div>
</form>
                            </div>
                        </div>
                                                    <div class="text-center text-muted mt-4">
                                <a tabindex="6" href="https://admin.globaldrinkshub.com/panel/register">Register</a>
                            </div>
                                            </div>
                </div>
                <div class="col-lg d-none d-lg-block">
                    <img src="https://preview.tabler.io/static/illustrations/undraw_secure_login_pdn4.svg" height="300" class="d-block mx-auto" alt="">
                </div>
            </div>
        </div>
    </div>


<footer class="d-print-none footer app-footer sticky-footer bg-transparent p-3 border-top-0">
        <div class="container-xl">
            <div class=" text-center align-items-center flex-row-reverse">
                                                    <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                        <ul class="list-inline list-inline-dots mb-0">
                            <li class="list-inline-item">
                                Handcrafted by
                                <a href="#" rel="noopener" target="_blank">Avangarde</a>.
                            </li>
                        </ul>
                    </div>
                            </div>
        </div>
    </footer>

<script src="https://unpkg.com/jquery@3.6.1/dist/jquery.min.js?6cf201c6ede4" ></script>
<script src="https://unpkg.com/@popperjs/core@2.11.6/dist/umd/popper.min.js?6cf201c6ede4" ></script>
<script src="https://unpkg.com/noty@3.2.0-beta-deprecated/lib/noty.min.js?6cf201c6ede4" ></script>
<script src="https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js?6cf201c6ede4" ></script>

                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js?6cf201c6ede4" ></script>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js?6cf201c6ede4" ></script>
            


<script type="text/javascript">
    // This is intentionaly run after dom loads so this way we can avoid showing duplicate alerts
    // when the user is beeing redirected by persistent table, that happens before this event triggers.
    document.onreadystatechange = function() {
        if (document.readyState == "interactive") {
            Noty.overrideDefaults({
                layout: 'topRight',
                theme: 'backstrap',
                timeout: 2500,
                closeWith: ['click', 'button'],
            });

            // get alerts from the alert bag
            var $alerts_from_php = [];

            // get the alerts from the localstorage
            var $alerts_from_localstorage = JSON.parse(localStorage.getItem('backpack_alerts')) ?
                JSON.parse(localStorage.getItem('backpack_alerts')) : {};

            // merge both php alerts and localstorage alerts
            Object.entries($alerts_from_php).forEach(function(type) {
                if (typeof $alerts_from_localstorage[type[0]] !== 'undefined') {
                    type[1].forEach(function(msg) {
                        $alerts_from_localstorage[type[0]].push(msg);
                    });
                } else {
                    $alerts_from_localstorage[type[0]] = type[1];
                }
            });

            for (var type in $alerts_from_localstorage) {
                let messages = new Set($alerts_from_localstorage[type]);

                messages.forEach(function(text) {
                    let alert = {};
                    alert['type'] = type;
                    alert['text'] = text;
                    new Noty(alert).show()
                });
            }

            // in the end, remove backpack alerts from localStorage
            localStorage.removeItem('backpack_alerts');
        }
    };
</script>

    <script>
$(document).ajaxComplete((e, result, settings) => {
    if(result.responseJSON?.exception !== undefined) {
        $.ajax({...settings, accepts: "text/html", backpackExceptionHandler: true});
    }
    else if(settings.backpackExceptionHandler) {
        Noty.closeAll();
        showErrorFrame(result.responseText);
    }
});

const showErrorFrame = html => {
    let page = document.createElement('html');
    page.innerHTML = html;
    page.querySelectorAll('a').forEach(a => a.setAttribute('target', '_top'));

    let modal = document.getElementById('ajax-error-frame');

    if (typeof modal !== 'undefined' && modal !== null) {
        modal.innerHTML = '';
    } else {
        modal = document.createElement('div');
        modal.id = 'ajax-error-frame';
        modal.style.position = 'fixed';
        modal.style.width = '100vw';
        modal.style.height = '100vh';
        modal.style.padding = '5vh 5vw';
        modal.style.backgroundColor = 'rgba(0, 0, 0, 0.4)';
        modal.style.zIndex = 200000;
    }

    let iframe = document.createElement('iframe');
    iframe.style.backgroundColor = '#17161A';
    iframe.style.borderRadius = '5px';
    iframe.style.width = '100%';
    iframe.style.height = '100%';
    iframe.style.border = '0';
    iframe.style.boxShadow = '0 0 4rem';
    modal.appendChild(iframe);

    document.body.prepend(modal);
    document.body.style.overflow = 'hidden';
    iframe.contentWindow.document.open();
    iframe.contentWindow.document.write(page.outerHTML);
    iframe.contentWindow.document.close();

    // Close on click
    modal.addEventListener('click', () => hideErrorFrame(modal));

    // Close on escape key press
    modal.setAttribute('tabindex', 0);
    modal.addEventListener('keydown', e => e.key === 'Escape' && hideErrorFrame(modal));
    modal.focus();
}

const hideErrorFrame = modal => {
    modal.outerHTML = '';
    document.body.style.overflow = 'visible';
}
</script>
<script src="/storage/basset/vendor/backpack/theme-tabler/resources/assets/js/tabler.js?6cf201c6ede4" ></script>
<script src="https://unpkg.com/@tabler/core@1.0.0-beta19/dist/js/tabler.min.js?6cf201c6ede4" ></script>

<script type="module">
    let input = document.querySelector('.password-visibility-toggler input');
    let buttons = document.querySelectorAll('.password-visibility-toggler a');

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            buttons.forEach(b => b.classList.toggle('d-none'));
            input.type = input.type === 'password' ? 'text' : 'password';
            input.focus();
        });
    });
</script>
    <script src="/storage/basset/vendor/backpack/crud/src/resources/assets/js/common.js?6cf201c6ede4" ></script>
</body>
</html>
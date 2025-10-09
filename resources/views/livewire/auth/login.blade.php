<main>
    <title>Volt Laravel Dashboard - Sign In</title>
    <section class="vh-100 d-flex flex-column flex-lg-row align-items-stretch">

        <!-- LEFT SIDE: IMAGE (HIDDEN ON SMALL SCREENS) -->
        <div class="col-lg-7 d-none d-lg-block p-0">
            <div class="h-100 w-100 bg-cover"
                style="background-image: url('/assets/img/pages/bg.jpg');
                       background-size: cover;
                       background-position: center;">
            </div>
        </div>

        <!-- RIGHT SIDE: FORM -->
        <div class="col-12 col-lg-5 d-flex align-items-center justify-content-center bg-white">
            <div class="w-100 px-4 py-5" style="max-width: 420px;">
                <div class="mb-4 mt-md-0 ">
                    <img src="/assets/img/pages/logopt.png" alt="ARHADI Logo" class="logo w-28 mx-auto mb-3">
                    <h1 class="text-2xl font-semibold text-gray-800">Welcome back</h1>
                    <p class="text-gray-500 text-sm">Please sign in to your account</p>
                </div>

                <!-- ORIGINAL FORM - UNCHANGED -->
                <form wire:submit.prevent="login" action="#" class="mt-4" method="POST">
                    <div class="form-group mb-4">
                        <label for="email">Your Email</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                    </path>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                </svg>
                            </span>
                            <input wire:model="email" type="email" class="form-control"
                                placeholder="example@company.com" id="email" autofocus required>
                        </div>
                        @error('email')
                        <div wire:key="form" class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="password">Your Password</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon2">
                                <svg class="icon icon-xs text-gray-600" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </span>
                            <input wire:model.lazy="password" type="password" placeholder="Password"
                                class="form-control" id="password" required>
                        </div>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-top mb-4">
                        <div class="form-check">
                            <input wire:model="remember_me" class="form-check-input" type="checkbox"
                                id="remember">
                            <label class="form-check-label mb-0" for="remember">Remember me</label>
                        </div>
                        <div>
                            <a href="{{ route('forgot-password') }}" class="small text-right">Lost password?</a>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-gray-800">Sign in</button>
                    </div>
                </form>

                <div class="d-flex justify-content-center align-items-center mt-4">
                    <span class="fw-normal">
                        Not registered?
                        <a href="{{ route('register') }}" class="fw-bold">Create account</a>
                    </span>
                </div>
            </div>
        </div>
    </section>
</main>

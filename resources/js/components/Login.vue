<template>
    <div class="row w-50 m-auto align-items-center justify-content-center mt-5">
        <h1 class="text-center">Login</h1>

        <div class="d-flex justify-content-center">

            <form class="form-control">
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Email address</label>
                    <input type="email" class="form-control" id="email" v-model="email" :disabled="loading" placeholder="Please enter your email address">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">Password</label>
                    <input type="password" class="form-control" id="password" v-model="password" :disabled="loading" placeholder="Please enter your password">
                </div>
                <div class="mb-3">
                    <button type="button" class="btn btn-success w-100" @click="login()">
                        {{ loading ? 'Logging In' : 'Login' }}
                    </button>
                </div>

                <p>Don't have an account? Click <a href="/register">here</a> to register</p>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                email: null,
                password: null,
                loading: false,
            };
        },
        methods: {
            login() {
                // Set loading state
                this.loading = true;

                // Submit to API for login request
                return axios.post('/api/login', {
                    email: this.email,
                    password: this.password
                })
                    .then(() => {

                        // Redirect to dashboard
                        window.location.href = '/';
                    })
                    .catch((error) => {

                        // Loop errors array from API
                        let errors = '';
                        for(let i = 0; i < error.response.data.length; i++) {
                            errors += '<li>'+error.response.data[i]+'</li>';
                        }

                        // Alert user of errors
                        this.$swal.fire({
                            icon: 'error',
                            html: errors,
                            showCloseButton: true,
                            confirmButtonText: 'Close',
                        })

                        // Reset loading state
                        this.loading = false;
                    });
            },
        },
    }
</script>

<template>
    <div class="row w-50 m-auto align-items-center justify-content-center mt-5">
        <h1 class="text-center">Register</h1>

        <div class="d-flex justify-content-center">

            <form class="form-control">
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Name</label>
                    <input type="text" class="form-control" id="name" v-model="name" :disabled="loading" placeholder="Please enter your name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Email address</label>
                    <input type="email" class="form-control" id="email" v-model="email" :disabled="loading" placeholder="Please enter your email address">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">Password</label>
                    <input type="password" class="form-control" id="password" v-model="password" :disabled="loading" placeholder="Please enter your password">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">Confirm Password</label>
                    <input type="password" class="form-control" id="password" v-model="password_confirmation" :disabled="loading" placeholder="Please re-enter your password">
                </div>
                <div class="mb-3">
                    <button type="button" class="btn btn-success w-100" @click="register()" :disabled="loading">
                        {{ loading ? 'Registering' : 'Register' }}
                    </button>
                </div>

                <p>Already have an account? Click <a href="/login">here</a> to login</p>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: null,
                email: null,
                password: null,
                password_confirmation: null,
                loading: false,
            };
        },
        methods: {
            register() {
                // Set loading state
                this.loading = true;

                // Submit to API for register request
                return axios.post('/api/register', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                })
                    .then(() => {

                        // Reset data to empty to stop form spam
                        Object.assign(this.$data, this.$options.data())

                        // Success alert for user
                        this.$swal.fire({
                            icon: 'success',
                            text: 'Account created successfully. Please verify it using the link sent to your email.',
                            showCloseButton: true,
                            confirmButtonText: 'Close',
                            timer: 3000,
                        }).then(() => {
                            window.location.href = "/activate"; // Redirect to account activation after 3 second swal timer
                        })
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

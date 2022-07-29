<template>
    <div class="limiter">
        <div class="login-container">
            <div class="login-wrapper" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1000">
                <span class="title">
                    Event Manager
                </span>
                <div class="input-row">
                    <span class="label">Email</span>
                    <input v-model="email" type="text" name="email" placeholder="Enter Email">
                    <span class="input-focus"></span>
                </div>

                <div class="input-row">
                    <span class="label">Password</span>
                    <input v-model="password" type="password" name="password" placeholder="Enter password">
                    <span class="input-focus"></span>
                </div>

                <div class="btn-container mt-5">
                    <button :disabled='disabled' @click="adminLogin()">
                        Login
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";
export default {
    name: 'AdminLogin',
    data() {
        return {
            email: '',
            password: '',
            disabled: false
        }
    },
    mounted() {

    },
    methods: {
        adminLogin: async function () {
            this.disabled = true;
            if (this.email && this.password) {
                try {
                    const user = await axios.post(
                        "login",
                        {
                            email: this.email,
                            password: this.password
                        }
                    );
                    if (user.data.status) {
                        this.email = '';
                        this.password = '';
                        this.$toast.success('Login Success !');
                    }
                    else {
                        this.$toast.error('Inalid Login Details.');
                    }
                    console.log(user);
                } catch (e) {
                    if (e.response.status === 422) {
                        let errors = e.response.data.errors;
                        Object.keys(errors).forEach(key => {
                            errors[key].forEach(element => {
                                this.$toast.error(element);
                            });
                        });
                    }
                }
            }
            else {
                this.$toast.error('All fields are required');
            }
            this.disabled = false;
        }
    },
}
</script>
<style lang="scss" scoped>
$dark : #32213A;

input,
button {
    outline: none;
    border: none;
}

.login-container {
    width: 100%;
    min-height: 100vh;
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    padding: 15px;
    background-repeat: no-repeat;
    background-position: bottom;
    background-size: cover;
    background-image: url('./../assets/login-bg.jpg');

    .login-wrapper {
        width: 500px;
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        width: 500px;
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        padding: 55px;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 20px 25px -5px, rgba(0, 0, 0, 0.04) 0px 10px 10px -5px;

        .title {
            color: $dark;
            text-transform: uppercase;
            display: block;
            font-weight: 700;
            font-size: 39px;
            line-height: 1.2;
            text-align: center;
            padding-bottom: 50px;
            user-select: none;
            -ms-user-select: none;
            -webkit-user-select: none
        }

        .input-row {
            width: 100%;
            position: relative;
            border-bottom: 2px solid #d9d9d9;
            margin-bottom: 23px;

            input {
                font-size: 17px;
                color: #333333;
                line-height: 1.2;
                display: block;
                width: 100%;
                height: 55px;
                background: transparent;
                padding-left: 5px;

                &:focus+.input-focus::before {
                    width: 100%;
                }
            }

            .input-focus {
                position: absolute;
                display: block;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                pointer-events: none;
            }

            .input-focus::before {
                content: "";
                display: block;
                position: absolute;
                bottom: -2px;
                left: 0;
                width: 0;
                height: 2px;
                background: #858786;
                -webkit-transition: all 0.4s;
                -o-transition: all 0.4s;
                -moz-transition: all 0.4s;
                transition: all 0.4s;
            }
        }

        .label {
            font-size: 17px;
            color: #333333;
            line-height: 1.5;
            padding-left: 7px;
            font-weight: bold;
        }

        .btn-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;

            button {
                border-radius: 25px;
                width: 100%;
                font-size: 16px;
                color: #fff;
                line-height: 1.2;
                text-transform: uppercase;
                padding: 0 20px;
                height: 50px;
                font-weight: 600;
                background-color: #32213A;

                &:hover {
                    background-color: #432D4E;
                }
            }
        }
    }
}

@media (max-width: 576px) {
    .login-wrapper {
        padding-left: 15px;
        padding-right: 15px;
    }
}
</style>
    

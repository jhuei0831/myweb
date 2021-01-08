<template>
	<validation-observer ref="observer" v-slot="{ invalid }">
		<p v-if="errors.length">
			<v-alert v-for="error in errors" :key="error" type="error">{{ error }}</v-alert>
		</p>
		<v-layout align-start justify-center>
			<v-card :elevation="10" :width="500">
				<v-form @submit.prevent="checkForm" id="loginform" ref="form" lazy-validation>
					<v-card-title class="cyan lighten-2 white--text">Login</v-card-title>
					<v-spacer></v-spacer>
					<v-card-text>
						<validation-provider v-slot="{errors}" name="Email" rules="required|email">
							<v-text-field :append-icon="showIcon ? 'mdi-email' : undefined" v-model="email" type="email" name="email" label="Email" :error-messages="errors" rounded outlined/>
						</validation-provider>
						<validation-provider v-slot="{errors}" name="密碼" rules="required|min:8">		
							<v-text-field :append-icon="showIcon ? 'mdi-security' : undefined" v-model="password" type="password" name="password" label="Password" :error-messages="errors" rounded outlined/>
						</validation-provider>
					</v-card-text>

					<v-card-actions>
						<v-spacer></v-spacer>
						<v-btn type="submit" color="teal lighten-2 white--text" :loading="loading" :disabled="invalid" @click="validate">登入</v-btn>
						<v-btn text color="teal lighten-2 white--text" @click="reveal = true">忘記密碼</v-btn>
					</v-card-actions>
				</v-form>
				<v-form @submit.prevent="forgot_password" id="forgot_password" ref="form2" lazy-validation>
					<v-expand-x-transition>
						<v-card v-if="reveal" class="transition-fast-in-fast-out v-card--reveal d-flex flex-column">
							<v-card-title class="orange lighten-2 white--text">忘記密碼</v-card-title>
							<v-spacer></v-spacer>
							<v-card-text>
								<p class="text-h6">請輸入帳號E-mail</p>
								<validation-provider v-slot="{errors}" name="Email" rules="required|email">
									<v-text-field append-icon='mdi-email' v-model="email_forgot" type="email" :error-messages="errors" name="email_forgot" label="Email"  rounded outlined/>
								</validation-provider>
							</v-card-text>
							<v-card-actions>
								<v-spacer></v-spacer>
								<v-btn color="orange lighten-2 white--text" :loading="loading" :disabled="invalid" @click="forgot_password_submit">送出</v-btn>
								<v-btn text color="orange lighten-2 white--text" @click="reveal = false">登入</v-btn>
							</v-card-actions>
						</v-card>
					</v-expand-x-transition>
				</v-form>
			</v-card>			
		</v-layout>
	</validation-observer>
</template>

<script>
	import { mapGetters, mapActions } from "vuex";
	import Swal from 'sweetalert2'
	import router from "../router/index.js"

	export default {
		mounted() {
			if (this.isLoggedIn) {
				Swal.fire({
					title: '您已登入',
					icon: 'error',
					confirmButtonText: '好喔',
				})
				router.push({ name: 'Home' })
			}
		},
		data() {
			return {
				reveal: false,
				dialog: false,
				showIcon: true,
				email: '',
				password: '',
				email_forgot: '',
			}
		},
		computed : {
			...mapGetters("auth", ["isLoggedIn", "loading", "errors"]),
			...mapGetters("users", ["loading"])
		},
		methods:{
			...mapActions("auth", ["login"]),
			...mapActions("users", ["forgot_password"]),
			validate () {
				this.$refs.form.validate()
			},
			checkForm: function (e) {
				var formContents = jQuery("#loginform").serialize();
				this.login(formContents)
			},
			forgot_password_submit() {
				let email = {email: this.email_forgot}
				this.forgot_password(email)
			}
		}
	}
</script>

<style>
	.v-card--reveal {
		bottom: 0;
		opacity: 1 !important;
		position: absolute;
		width: 100%;
		height: 100%;
	}
</style>
<template>
	<v-layout align-start justify-center>
		<v-form v-model="isValid" @submit.prevent="checkForm" id="loginform" ref="form" lazy-validation>
			<p v-if="errors.length">
				<v-alert v-for="error in errors" :key="error" type="error">{{ error }}</v-alert>
			</p>
			<v-card :elevation="10" :width="500">
				<v-card-title class="cyan lighten-2 white--text">Login</v-card-title>
				<v-spacer></v-spacer>
				<v-card-text>
					<v-text-field :append-icon="showIcon ? 'mdi-email' : undefined" v-model="email" type="email" name="email" label="Email" :rules="emailRules" rounded outlined/>
					<v-text-field :append-icon="showIcon ? 'mdi-security' : undefined" v-model="password" type="password" name="password" label="Password" :rules="passwordRules" rounded outlined/>
				</v-card-text>

				<v-card-actions>
					<v-spacer></v-spacer>
					<v-btn type="submit" color="teal lighten-2 white--text" :loading="loading" :disabled="!isValid" @click="validate">
						Submit
					</v-btn>
				</v-card-actions>
			</v-card>
		</v-form>
	</v-layout>
</template>

<script>
	import { mapGetters, mapActions } from "vuex";

	export default {
		mounted() {
			// console.log('Component mounted.')
		},
		data() {
			return {
				showIcon: true,
				isValid: true,
				email: '',
				emailRules: [
					v => !!v || 'E-mail is required',
					v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
				],
				password: '',
				passwordRules: [
					v => !!v || 'Password is required',
					v => (v && v.length >= 8) || 'Password must be more than 8 characters',
				],
			}
		},
		computed : {
			...mapGetters("auth", ["isLoggedIn", "loading", "errors"])
		},
		methods:{
			...mapActions("auth", ["login"]),
			validate () {
				this.$refs.form.validate()
			},
			checkForm: function (e) {
				var formContents = jQuery("#loginform").serialize();
				this.login(formContents)
			}
		}
	}
</script>
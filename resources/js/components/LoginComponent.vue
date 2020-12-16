<template>
	<v-app>
		<v-main>
			<v-container>
				<v-layout align-top justify-center>
					<v-form v-model="isValid" @submit="checkForm" id="createAdministrator" ref="form" lazy-validation>
						<p v-if="errors.length">
							<v-alert v-for="error in errors" :key="error" type="error">{{ error }}</v-alert>
						</p>
						<v-card :elevation="10" :width="500">
							<v-card-title class="cyan lighten-2 white--text">Login</v-card-title>
							<v-spacer></v-spacer>
							<v-card-text>
								<v-text-field :append-icon="showIcon ? 'edit' : undefined" v-model="email" type="email" name="email" label="Email" :rules="emailRules" rounded outlined/>
								<v-text-field v-model="password" type="password" name="password" label="Password" :rules="passwordRules" rounded outlined/>
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
			</v-container>
		</v-main>	
	</v-app>	
</template>

<script>
	export default {
		mounted() {
			console.log('Component mounted.')
		},
		data() {
			return {
				showIcon: true,
				isValid: true,
				errors: [],
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
        		loading: false
			}
		},
		methods:{
			validate () {
				this.$refs.form.validate()
			},
			checkForm: function (e) {
				this.loading = true;
				this.errors = [];

				var formContents = jQuery("#createAdministrator").serialize();

				axios.post('/api/login', formContents)
				.then((response) => {
					this.loading = false;
                   	alert(response.data.token);
                })
				.catch((error) => {
					this.loading = false;
					this.errors.push(error.response.data.message);
                });

				e.preventDefault();
			}
		}
	}
</script>
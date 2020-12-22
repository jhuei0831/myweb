<template>
	<v-app>
		<v-navigation-drawer v-model="drawer" app>
			<v-list rounded dense v-if="isLoggedIn">
				<v-list-item class="justify-center">
					<v-list-item-avatar>
						<v-img src="https://cdn.vuetifyjs.com/images/john.png"></v-img>
					</v-list-item-avatar>
				</v-list-item>
				<v-list-item link>
					<v-list-item-content>
						<v-list-item-title class="title">{{ userdata.name }}</v-list-item-title>
						<v-list-item-subtitle>{{ userdata.email }}</v-list-item-subtitle>
					</v-list-item-content>
					<v-list-item-action>
						<v-icon>mdi-menu-down</v-icon>
					</v-list-item-action>
				</v-list-item>
				<v-divider></v-divider>
				<v-list-item-group v-model="selectedItem" color="primary">
					<v-list-item to="/" class="text-decoration-none">
						<v-list-item-icon><v-icon>mdi-home</v-icon></v-list-item-icon>
						<v-list-item-content><v-list-item-title>Home</v-list-item-title></v-list-item-content>
					</v-list-item>
					<v-list-item to="/about" class="text-decoration-none">
						<v-list-item-icon><v-icon>mdi-card-account-details</v-icon></v-list-item-icon>
						<v-list-item-content><v-list-item-title>About</v-list-item-title></v-list-item-content>
					</v-list-item>
					<v-list-item v-if="can('role-list')" to="/roles">
						<v-list-item-icon><v-icon>mdi-account</v-icon></v-list-item-icon>
						<v-list-item-content><v-list-item-title>Role</v-list-item-title></v-list-item-content>
					</v-list-item>
				</v-list-item-group>
				<v-divider></v-divider>
			</v-list>
			
			<v-list dense>
				<v-list-item to="/login" v-if="!isLoggedIn" class="text-decoration-none">
						<v-list-item-icon><v-icon>mdi-login-variant</v-icon></v-list-item-icon>
						<v-list-item-content><v-list-item-title>Login</v-list-item-title></v-list-item-content>									
				</v-list-item>
				<v-list-item v-if="isLoggedIn" link>
					<v-list-item-icon><v-icon>mdi-logout-variant</v-icon></v-list-item-icon>
					<v-list-item-content><v-list-item-title @click="logout()">Logout</v-list-item-title></v-list-item-content>
				</v-list-item>
			</v-list>
		</v-navigation-drawer>

		<v-app-bar app>
			<v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
			<v-toolbar-title>MyWeb</v-toolbar-title>
		</v-app-bar>

		<v-main app>
			<v-container fluid>
				<router-view />	
			</v-container>
		</v-main>

		<v-footer app>
			<v-col class="text-center"><strong>{{ new Date().getFullYear() }} Jhuei</strong></v-col>
		</v-footer>
	</v-app>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
	data: () => ({ 
		drawer: null,
		selectedItem: 0,
	}),
	mounted() {
		if (this.isLoggedIn) {
			this.getUser()
		}
	},
	computed: {
		...mapGetters("auth", ["isLoggedIn", "userdata"]),
	},
	methods: {
		...mapActions("auth", ["getUser", "logout"]),
	},
};
</script>

<style>
    a {
        text-decoration: none !important;
    }
</style>
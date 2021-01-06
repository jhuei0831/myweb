<template>
	<v-app id="">
		<v-navigation-drawer v-model="drawer" app color="grey lighten-4">
			<v-list rounded dense v-if="isLoggedIn">
				<v-list-item class="justify-center">
					<v-list-item-avatar>
						<v-img :src="userdata.photo ? userdata.photo : 'https://cdn2.ettoday.net/images/1457/d1457772.jpg'"></v-img>
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
						<v-list-item-content><v-list-item-title>Roles</v-list-item-title></v-list-item-content>
					</v-list-item>
					<v-list-item v-if="can('user-list')" to="/users">
						<v-list-item-icon><v-icon>mdi-account-multiple</v-icon></v-list-item-icon>
						<v-list-item-content><v-list-item-title>Users</v-list-item-title></v-list-item-content>
					</v-list-item>
					<v-list-item v-if="can('log-list')" to="/logs">
						<v-list-item-icon><v-icon>mdi-file-document-multiple</v-icon></v-list-item-icon>
						<v-list-item-content><v-list-item-title>Logs</v-list-item-title></v-list-item-content>
					</v-list-item>
				</v-list-item-group>
				<v-divider></v-divider>
			</v-list>
			
			<v-list dense>
				<v-list-item to="/login" v-if="!isLoggedIn" class="text-decoration-none">
					<v-list-item-icon><v-icon>mdi-login-variant</v-icon></v-list-item-icon>
					<v-list-item-content><v-list-item-title>Login</v-list-item-title></v-list-item-content>									
				</v-list-item>
				<v-list-item v-if="isLoggedIn" @click="logout()" link>
					<v-list-item-icon><v-icon>mdi-logout-variant</v-icon></v-list-item-icon>
					<v-list-item-content><v-list-item-title>Logout</v-list-item-title></v-list-item-content>
				</v-list-item>
			</v-list>
		</v-navigation-drawer>

		<v-app-bar app color="grey lighten-4">
			<v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
			<v-toolbar-title>MyWeb</v-toolbar-title>
			<v-spacer></v-spacer>
		</v-app-bar>

		<v-main app>
			<v-container fluid class="mb-6">
				<router-view />	
			</v-container>
		</v-main>

		<v-footer app color="grey lighten-4">
			<v-col class="text-center"><strong>{{ new Date().getFullYear() }} &copy; Jhuei</strong></v-col>
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
	#bg {
		background: url('https://i.pinimg.com/originals/cb/c2/2c/cbc22ca5a3d7568a742262639a9f6b3f.jpg');
		/* background: url('https://marketplace.canva.com/EAEMngvLCL0/1/0/800w/canva-green-foliage-holiday-zoom-virtual-background-lFKQ1lGmxs4.jpg'); */
		/* Full height */
		height: 100%;
		/* Center and scale the image nicely */
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
	}
</style>
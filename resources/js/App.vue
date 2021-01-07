<template>
	<v-app id="bg">
		<v-system-bar height="56" app  color="teal lighten-3">
			<v-layout row wrap justify-center>
				<img width="196" src="https://lo2y.com/wp-content/uploads/2016/02/hello-world-510x219.png" alt="logo">
			</v-layout>
		</v-system-bar>
		<v-navigation-drawer class="hidden-sm-and-up" v-model="drawer" app color="grey lighten-4" floating id="nav-drawer">
			<v-list rounded dense v-if="isLoggedIn">
				<v-list-item class="justify-center">
					<router-link to="/About" tag="span" style="cursor: pointer">
						<v-list-item-avatar size="80">
							<v-img :src="userdata.photo ? userdata.photo : 'https://cdn2.ettoday.net/images/1457/d1457772.jpg'" alt="photo"></v-img>
						</v-list-item-avatar>
					</router-link>
				</v-list-item>
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

		<v-app-bar app color="transparent" elevation="0" dark>
			<span class="hidden-sm-and-up"><v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon></span>
			<router-link to="/" tag="span" style="cursor: pointer"><v-toolbar-title class="font-weight-bold">MyWeb</v-toolbar-title></router-link>
			<v-spacer></v-spacer>
			<v-toolbar-items class="hidden-xs-only" v-if="!isLoggedIn">
				<v-btn text v-for="item in menuItems" :key="item.title" :to="item.path">
          			<v-icon left dark>{{ item.icon }}</v-icon>{{ item.title }}
        		</v-btn>
      		</v-toolbar-items>
			<v-toolbar-items class="hidden-xs-only" v-if="isLoggedIn">
				<v-btn text v-if="can('role-list')" to="/roles" class="font-weight-bold"><v-icon left>mdi-account</v-icon>Roles</v-btn>
				<v-btn text v-if="can('user-list')" to="/users" class="font-weight-bold"><v-icon left>mdi-account-multiple</v-icon>Users</v-btn>
				<v-btn text v-if="can('log-list')" to="/logs" class="font-weight-bold"><v-icon left>mdi-file-document-multiple</v-icon>Logs</v-btn>	
				<v-menu bottom min-width="200px" rounded offset-y>
					<template v-slot:activator="{ on }">
						<v-btn icon x-large v-on="on">
							<v-avatar size="48">
								<v-img :src="userdata.photo ? userdata.photo : 'https://cdn2.ettoday.net/images/1457/d1457772.jpg'" alt="photo"></v-img>
							</v-avatar>
						</v-btn>
					</template>
					<v-card>
						<v-list-item-content class="justify-center">
							<div class="mx-auto text-center">
								<h3>{{ userdata.name }}</h3>
								<p class="mt-1">{{ userdata.email }}</p>
								<v-divider></v-divider>
								<v-btn depressed rounded text to="/About"><v-icon left>mdi-card-account-details</v-icon>Account Info</v-btn>
								<v-divider></v-divider>
								<v-btn @click="logout()" depressed rounded text><v-icon left>mdi-logout-variant</v-icon>Logout</v-btn>
							</div>
						</v-list-item-content>
					</v-card>
				</v-menu>				
      		</v-toolbar-items>
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
import router from "./router/index.js"

export default {
	data: () => ({ 
		drawer: false,
		selectedItem: 0,
		menuItems: [
			{ title: 'Login', path: '/login', icon: 'mdi-login-variant' }
		],
		user: {
        initials: 'JD',
        fullName: 'John Doe',
        email: 'john.doe@doe.com',
      },
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
		goAbout() {
			router.push({ name: 'About' })
		}
	},
};
</script>

<style>
    a {
        text-decoration: none !important;
    }
	#bg {
		/* background-color: rgb(85, 88, 88); */
		background: url('./assets/man.jpg');
		/* background: url('https://marketplace.canva.com/EAEMngvLCL0/1/0/800w/canva-green-foliage-holiday-zoom-virtual-background-lFKQ1lGmxs4.jpg'); */
		/* Full height */
		height: 100%;
		/* Center and scale the image nicely */
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
		font-family: "Nunito", "Microsoft JhengHei";
	}
	#nav-drawer .v-list-item__title{
		font-weight: bold;
	}
	#back{position:absolute;top:0;left:0;}
</style>
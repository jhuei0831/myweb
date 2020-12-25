import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import zhHant from 'vuetify/src/locale/zh-Hant.ts'
Vue.use(Vuetify)

const opts = {
	icons: {
	    iconfont: 'mdi', // default - only for display purposes
	},
	lang: {
		locales: { zhHant },
		current: 'zhHant',
	},
}

export default new Vuetify(opts)
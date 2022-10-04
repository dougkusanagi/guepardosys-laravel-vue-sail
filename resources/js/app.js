import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp, Link, Head } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";
import DashboardLayout from "@/Layout/DashboardLayout.vue";

// const appName =
// 	window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

createInertiaApp({
	title: (title) => `${title} - GuepardoSys`,
	resolve: async (name) => {
		const page = (
			await resolvePageComponent(
				`./Pages/${name}.vue`,
				import.meta.glob("./Pages/**/*.vue")
			)
		).default;

		if (page.layout === undefined) {
			page.layout = DashboardLayout;
		}

		return page;
	},
	setup({ el, app, props, plugin }) {
		return (
			createApp({ render: () => h(app, props) })
				.use(plugin)
				.use(ZiggyVue, Ziggy)
				.component("Link", Link)
				.component("Head", Head)
				.directive('focus', el => el.focus())		// enable v-focus on component
				.mount(el)
		);
	},
});

InertiaProgress.init({ color: "#4B5563" });

<template>
	<aside class="h-[100vh] w-[12rem] p-4 fixed">
		<div
			class="h-full flex flex-col items-end bg-[#11183C] text-blue-200 rounded-[60px] text-xs dark:bg-[#11183C] dark:text-blue-200"
		>
			<div
				class="w-24 border300 mt-10 mx-auto border-4 border-white rounded-2xl hover:shadow-xl"
			>
				<Link :href="route('dashboard')">
					<LogoGuepardoSys />
				</Link>
			</div>

			<div class="flex flex-col mt-6 items-end">
				<NavbarItem
					v-for="item in navbarItems"
					:label="item.label"
					:link="item.link"
					:active="$page.component.startsWith(item.component)"
					:key="item.id"
				>
					<component :is="item.icon"></component>
				</NavbarItem>
			</div>
		</div>
	</aside>
</template>

<script setup>
import NavbarItem from "@/Components/NavbarItem.vue";
import Chart from "@/Icons/Chart.vue";
import Bag from "@/Icons/Bag.vue";
import InboxStack from "@/Icons/InboxStack.vue";
import LogoGuepardoSys from "@/Icons/LogoGuepardoSys.vue";

const navbarItems = [
	// {
	// 	id: 0,
	// 	label: "Dashboard",
	// 	link: route("dashboard"),
	// 	icon: Chart,
	// 	component: "Dashboard",
	// },
	{
		id: 1,
		label: "Produtos",
		link: route("product.index", { order_by_field: "name", direction: "asc" }),
		icon: Bag,
		component: "Product/",
	},
	{
		id: 2,
		label: "Categorias",
		link: route("category.index"),
		icon: InboxStack,
		component: "Category/",
	},
];
</script>

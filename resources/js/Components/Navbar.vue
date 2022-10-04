<template>
	<aside class="h-[100vh] w-[12rem] p-4 fixed">
		<div
			class="h-full bg-[#1f295a] flex flex-col items-end text-blue-200 rounded-[60px] text-xs"
		>
			<div class="w-16 h-16 border border-slate-300 mt-11 mx-auto"></div>

			<div class="flex flex-col mt-11 items-end">
				<NavbarItem
					v-for="item in navbarItems"
					:label="item.label"
					:link="item.link"
					:active="$page.component.startsWith(item.component)"
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

const navbarItems = [
	{
	  label: 'Dashboard',
	  link: route('dashboard'),
	  icon: Chart,
	  component: "Dashboard"
	},
	{
		label: "Produtos",
		link: route("product.index", { 'orderByField': 'name', 'direction': 'asc' }),
		icon: Bag,
		component: "Product/",
	},
	{
		label: "Categorias",
		link: route("category.index"),
		icon: InboxStack,
		component: "Category/",
	},
];

</script>

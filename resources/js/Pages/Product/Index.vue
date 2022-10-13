<template>
	<Head title="Produtos" />

	<div class="pt-12 px-6">
		<LayoutHeader :breadcrumbs-links="breadcrumbsLinks">
			<template #header-title>
				Lista de Produtos
				<Link
					class="w-8 h-8 flex items-center justify-center btn-primary text-white rounded-lg rounded-br-none mr-12 ml-3 p-2"
					:href="route('product.add')+'#card-images'"
				>
					<PlusIcon />
				</Link>
			</template>

			<template #append>
				<div class="flex justify-between md:flex-1 md:justify-end">
					<ButtonGoBack />
				</div>
			</template>
		</LayoutHeader>

		<div class="flex mb-6 border-b border-slate-300">
			<TabsFilterByStatusLink
				:isActive="!route().params.status"
				:count="props.products_count.total"
				label="Todos"
				@click="filterByStatus(null)"
			/>

			<TabsFilterByStatusLink
				:isActive="route().params.status === product_status_all.Active"
				:count="props.products_count.totalActive"
				label="Ativos"
				@click="filterByStatus(product_status_all.Active)"
			/>

			<TabsFilterByStatusLink
				:isActive="route().params.status === product_status_all.Inactive"
				:count="props.products_count.totalInactive"
				label="Inativos"
				@click="filterByStatus(product_status_all.Inactive)"
			/>

			<TabsFilterByStatusLink
				:isActive="route().params.status === product_status_all.Waiting"
				:count="props.products_count.totalWaiting"
				label="Aguardando"
				@click="filterByStatus(product_status_all.Waiting)"
			/>
		</div>

		<LayoutSection class="bg-white rounded-lg">
			<div class="md:flex md:space-x-4 mb-4">
				<div class="w-1/3 relative flex-1">
					<FormInputText
						placeholder="Digite o nome do produto..."
						name="stock_virtual"
						id="stock_virtual"
						type="search"
						v-model="queryParams.search"
					/>
				</div>

				<div class="w-1/3">
					<FormSelect v-model="queryParams.category" :options="categories_all_complete" />
				</div>

				<span class="flex items-center justify-center flex-1 ml text-[#969bba] text-center">
					{{ props.products.total }} encontrados
				</span>
			</div>

			<div class="flex items-center bg-slate-50 text-slate-600 border-y p-3 dark:bg-[#11183C] dark:brightness-75 dark:border-none dark:text-slate-200">
				<!-- <input class="border-slate-300" type="checkbox" name="[]" /> -->

				<div class="w-16 h-0 opacity-0 mx-2" alt="Produto"></div>

				<span
					class="flex font-bold mx-3 cursor-pointer"
					@click="sort('name')"
				>
					<span
						class="mr-1"
						:class="route().params.order_by !== 'name' ? 'hidden' : ''"
					>
						<ArrowUp
							:class="route().params.direction === 'desc' ? 'rotate-180' : ''"
						/>
					</span>
					Nome
				</span>

				<span
					class="flex font-bold cursor-pointer ml-auto mr-4"
					@click="sort('status')"
				>
					<span
						class="mr-1"
						:class="route().params.order_by !== 'status' ? 'hidden' : ''"
					>
						<ArrowUp
							:class="route().params.direction === 'desc' ? 'rotate-180' : ''"
						/>
					</span>
					Status
				</span>
			</div>

			<div
				class="bg-white border-slate-200 overflow-hidden border-b shadow-sm dark:bg-[#11183C] dark:border-slate-700"
				v-for="product in props.products.data"
				:key="product.id"
			>
				<div class="flex items-center space-x-4 py-4 px-6">
					<!-- <input class="border-slate-300" type="checkbox" name="[]" /> -->

					<a href="#">
						<img
							class="w-16 h-16 object-fill rounded-full"
							:src="`https://picsum.photos/seed/${product.name
								.split(' ')
								.join('-')}/200/300`"
							alt="Produto"
						/>
					</a>

					<div class="flex flex-col flex-1 justify-center">
						<h3 class="text-xs text-slate-400">
							{{ product.category.name }}
						</h3>

						<h2 class="text-lg font-bold">{{ product.name }}</h2>
					</div>

					<div class="flex items-end">
						<div
							class="flex items-center mr-4"
							:class="{
								'text-emerald-400': product.status == 'active',
								'text-red-400': product.status == 'inactive',
								'text-yellow-500': product.status == 'waiting',
							}"
						>
							<div
								class="w-2 h-2 rounded-full mr-2"
								:class="{
									'bg-emerald-400': product.status == 'active',
									'bg-red-400': product.status == 'inactive',
									'bg-yellow-500': product.status == 'waiting',
								}"
							></div>
							{{ product.status }}
						</div>
					</div>
				</div>
			</div>
		</LayoutSection>
	</div>
</template>

<script setup>
import { Inertia } from "@inertiajs/inertia";
import { reactive, watch, computed } from "vue";
import PlusIcon from "@/Icons/Plus.vue";
import ArrowUp from "@/Icons/ArrowUp.vue";
import MagnifyingGlass from "@/Icons/MagnifyingGlass.vue";
import TabsFilterByStatusLink from "@/Components/TabsFilterByStatusLink.vue";
import LayoutHeader from "@/Components/LayoutHeader.vue";
import ButtonGoBack from "@/Components/ButtonGoBack.vue";
import LayoutSection from "@/Components/LayoutSection.vue";
import FormLabel from "@/Components/Form/FormLabel.vue";
import FormInputText from "@/Components/Form/FormInputText.vue";
import FormSelect from "@/Components/Form/FormSelect.vue";

const props = defineProps({
	products: Object,
	products_count: Object,
	categories_all: Array,
	product_status_all: Object,
});

const breadcrumbsLinks = [
	{
		label: "Dashboard",
		link: route("dashboard"),
		isHome: true,
	},
	{
		label: "Produtos",
		link: route("product.index", {
			order_by: "name",
			direction: "asc",
		}),
	},
	{
		label: "Lista",
	},
];

const queryParams = reactive({
	search: "",
	order_by: "name",
	direction: "asc",
	status: "",
	category: "",
});

watch(
	queryParams,
	() => {
		Inertia.get(route("product.index"), queryParams, {
			replace: true,
			preserveState: true,
		});
	},
	{ deep: true }
);

const sort = (field) => {
	if (queryParams.order_by === field) {
		queryParams.direction = queryParams.direction === "asc" ? "desc" : "asc";
	} else {
		queryParams.direction = "asc";
	}

	queryParams.order_by = field;
};

const filterByStatus = (status) => (queryParams.status = status);

const categories_all_complete = computed(() => {
	return [
		{ name: 'Todas as categorias', id: '' }
		,...props.categories_all
	]
});
</script>

<template>
	<Head title="Produtos" />

	<div class="pt-12 px-6">
		<div class="flex mb-2">
			<Breadcrumb :items="breadcrumbs" />
		</div>

		<div class="flex items-center mb-12">
			<h1 class="font-bold text-3xl">Lista de Produtos</h1>

			<Link
				class="w-8 h-8 flex items-center justify-center bg-cyan-300 text-white rounded-lg rounded-br-none mr-12 ml-3 p-2"
				:href="route('product.add')"
			>
				<Plus />
			</Link>
		</div>

		<div class="flex mb-6 border-b border-slate-300">
			<ProductTabFilterByStatus
				:isActive="!route().params.status"
				:count="count_products[0].total"
				label="Todos"
				@click="filterByStatus(null)"
			/>

			<ProductTabFilterByStatus
				:isActive="route().params.status === 'active'"
				:count="count_products[0].totalActive"
				label="Ativos"
				@click="filterByStatus('active')"
			/>

			<ProductTabFilterByStatus
				:isActive="route().params.status === 'inactive'"
				:count="count_products[0].totalInactive"
				label="Inativos"
				@click="filterByStatus('inactive')"
			/>

			<ProductTabFilterByStatus
				:isActive="route().params.status === 'waiting'"
				:count="count_products[0].totalWaiting"
				label="Aguardando"
				@click="filterByStatus('waiting')"
			/>
		</div>

		<div class="bg-white rounded-lg">
			<div class="flex items-center justify-between space-x-4 p-4">
				<div class="w-1/3 relative flex-1">
					<div
						class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none"
					>
						<MagnifyingGlass />
					</div>

					<input
						type="search"
						class="w-full h-12 block font-medium text-sm text-slate-500 border border-slate-300 focus:ring-indigo-600 focus:border-indigo-600 rounded-lg pl-10"
						placeholder="Pesquisar nome do produto"
						v-model="queryParams.search"
						autofocus
					/>
				</div>

				<div class="w-1/3">
					<!-- <Combobox :option-list="categories_all">
						Escolha uma Categoria
					</Combobox> -->

					<select
						class="select select-bordered w-full"
						v-model="queryParams.category"
					>
						<option selected value="">Todas as Categoria</option>
						<option
							v-for="category in categories_all"
							:key="category.id"
							:value="category.id"
						>
							{{ category.name }}
						</option>
					</select>
				</div>

				<span class="flex-1 ml text-[#969bba] text-center">
					{{ products.total }} encontrados
				</span>
			</div>

			<div class="flex items-center bg-slate-50 border-y p-3">
				<input class="border-slate-300" type="checkbox" name="[]" />

				<div class="w-16 h-0 opacity-0 mx-2" alt="Produto"></div>

				<span
					class="flex text-slate-600 font-bold mx-3 cursor-pointer"
					@click="sort('name')"
				>
					<span
						class="mr-1"
						:class="
							route().params.order_by_field !== 'name'
								? 'hidden'
								: ''
						"
					>
						<ArrowUp
							:class="
								route().params.direction === 'desc'
									? 'rotate-180'
									: ''
							"
						/>
					</span>
					Nome
				</span>

				<span
					class="flex text-slate-600 font-bold cursor-pointer ml-auto mr-4"
					@click="sort('status')"
				>
					<span
						class="mr-1"
						:class="
							route().params.order_by_field !== 'status'
								? 'hidden'
								: ''
						"
					>
						<ArrowUp
							:class="
								route().params.direction === 'desc'
									? 'rotate-180'
									: ''
							"
						/>
					</span>
					Status
				</span>
			</div>

			<div
				class="bg-white overflow-hidden border-b border-slate-200 shadow-sm"
				v-for="product in products.data"
				:key="product.id"
			>
				<div class="flex items-center space-x-4 p-3">
					<input class="border-slate-300" type="checkbox" name="[]" />
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
									'bg-emerald-400':
										product.status == 'active',
									'bg-red-400': product.status == 'inactive',
									'bg-yellow-500':
										product.status == 'waiting',
								}"
							></div>
							{{ product.status }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script setup>
import { Inertia } from "@inertiajs/inertia";
import { reactive, watch } from "vue";
import Plus from "@/Icons/Plus.vue";
import ArrowUp from "@/Icons/ArrowUp.vue";
import MagnifyingGlass from "@/Icons/MagnifyingGlass.vue";
import ProductTabFilterByStatus from "@/Components/ProductTabFilterByStatus.vue";
import Breadcrumb from "@/Components/Breadcrumb.vue";
import Combobox from "@/Components/Combobox.vue";

defineProps({
	products: Object,
	count_products: Array,
	categories_all: Array,
});

const breadcrumbs = [
	{
		label: "Dashboard",
		link: route("dashboard"),
		isHome: true,
	},
	{
		label: "Produtos",
		link: route("product.index", {
			order_by_field: "name",
			direction: "asc",
		}),
	},
	{
		label: "Lista",
	},
];

const queryParams = reactive({
	search: "",
	order_by_field: "name",
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
	if (queryParams.order_by_field === field) {
		queryParams.direction =
			queryParams.direction === "asc" ? "desc" : "asc";
	} else {
		queryParams.direction = "asc";
	}

	queryParams.order_by_field = field;
};

const filterByStatus = (status) => (queryParams.status = status);
</script>

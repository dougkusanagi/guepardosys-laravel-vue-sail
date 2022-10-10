<template>
	<Head title="Produtos" />

	<div class="pt-12 px-6">
		<LayoutHeader :breadcrumbs-links="breadcrumbsLinks">
			<template #header-title>
				Lista de Produtos
				<Link
					class="w-8 h-8 flex items-center justify-center bg-cyan-300 text-white rounded-lg rounded-br-none mr-12 ml-3 p-2"
					:href="route('product.add')"
				>
					<Plus />
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
				:isActive="route().params.status === 'active'"
				:count="props.products_count.totalActive"
				label="Ativos"
				@click="filterByStatus('active')"
			/>

			<TabsFilterByStatusLink
				:isActive="route().params.status === 'inactive'"
				:count="props.products_count.totalInactive"
				label="Inativos"
				@click="filterByStatus('inactive')"
			/>

			<TabsFilterByStatusLink
				:isActive="route().params.status === 'waiting'"
				:count="props.products_count.totalWaiting"
				label="Aguardando"
				@click="filterByStatus('waiting')"
			/>
		</div>

		<LayoutSection class="bg-white rounded-lg">
			<template #header>Pesquisar</template>

			<div class="md:flex md:space-x-4 mb-4">
				<div class="w-1/3 relative flex-1">
					<!-- <div
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
					/> -->

					<FormInputText
						placeholder="ex: 19.98"
						name="stock_virtual"
						id="stock_virtual"
						min="0"
						v-model="queryParams.search"
					/>
				</div>

				<div class="w-1/3">
					<!-- <select
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
					</select> -->

					<FormSelect v-model="queryParams.category" :options="categories_all" />
				</div>

				<span class="flex items-center justify-center flex-1 ml text-[#969bba] text-center">
					{{ props.products.total }} encontrados
				</span>
			</div>

			<div class="flex items-center bg-slate-50 text-slate-600 border-y p-3 dark:bg-[#11183C] dark:brightness-90 dark:border-slate-600">
				<input class="border-slate-300" type="checkbox" name="[]" />

				<div class="w-16 h-0 opacity-0 mx-2" alt="Produto"></div>

				<span
					class="flex font-bold mx-3 cursor-pointer"
					@click="sort('name')"
				>
					<span
						class="mr-1"
						:class="route().params.order_by_field !== 'name' ? 'hidden' : ''"
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
						:class="route().params.order_by_field !== 'status' ? 'hidden' : ''"
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
import { reactive, watch } from "vue";
import Plus from "@/Icons/Plus.vue";
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
		queryParams.direction = queryParams.direction === "asc" ? "desc" : "asc";
	} else {
		queryParams.direction = "asc";
	}

	queryParams.order_by_field = field;
};

const filterByStatus = (status) => (queryParams.status = status);
</script>

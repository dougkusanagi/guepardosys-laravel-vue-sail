<template>
	<div class="pt-12 px-6">
		<div class="flex mb-2">
			<Breadcrumb :items="breadcrumbs" />
		</div>

		<h1 class="font-bold text-3xl mb-6">Cadastro de Produto</h1>

		<div class="flex space-x-6">
			<div
				class="hidden lg:flex flex-col w-96 bg-white p-4 font-bold space-y-1 sticky top-0 h-max"
			>
				<a href="#info" class="relative py-2 bg-slate-100">
					<div
						class="flex absolute inset-y-0 left-0 items-center pl-4"
					>
						<InformationCircleIcon class="h-5 w-5" />
					</div>

					<span class="ml-12">Informações</span>
				</a>

				<a href="#image" class="relative py-2 bg-slate-100">
					<div
						class="flex absolute inset-y-0 left-0 items-center pl-4"
					>
						<PhotoIcon class="h-5 w-5" />
					</div>

					<span class="ml-12">Imagens</span>
				</a>

				<a href="#image" class="relative py-2 bg-slate-100">
					<div
						class="flex absolute inset-y-0 left-0 items-center pl-4"
					>
						<PhotoIcon class="h-5 w-5" />
					</div>

					<span class="ml-12">Imagens</span>
				</a>
			</div>

			<div class="w-full">
				<div id="info" class="bg-white rounded-lg p-4 mb-6">
					<h2 class="text-xl font-bold mb-6">Informações</h2>

					<div class="md:flex mb-6 md:space-x-4">
						<div class="w-full md:w-1/2 mb-4">
							<input-text
								label="Nome do Produto"
								placeholder="ex: Cartão de visitas"
								name="name"
								v-model="data.productName"
								v-focus
							/>
						</div>

						<div class="w-full md:w-1/2 mb-4">
							<input-text
								label="Slug"
								placeholder="ex: cartao-de-visitas"
								name="slug"
								v-model="slug"
							/>
						</div>
					</div>

					<div class="md:flex mb-6 md:space-x-4">
						<div class="w-full md:w-1/2 mb-4">
							<input-text
								label="Preço"
								type="number"
								placeholder="ex: 19.98"
								name="price"
								min="0"
								step="0.01"
							/>
						</div>

						<div class="w-full md:w-1/2 mb-4">
							<input-group />
						</div>
					</div>
				</div>

				<div id="image" class="bg-white rounded-lg p-4 mb-6">
					<h2 class="text-xl font-bold mb-6">Imagens</h2>
				</div>
			</div>
		</div>
	</div>
</template>

<script setup>
import InputText from "@/Components/Form/InputText.vue";
import Breadcrumb from "@/Components/Breadcrumb.vue";
import { InformationCircleIcon, PhotoIcon } from "@heroicons/vue/20/solid";
import { reactive, computed } from "vue";
import { slugfy } from "@/helpers/string";
import InputGroup from "@/Components/Form/InputGroup.vue";

const breadcrumbs = [
	{
		label: "Dashboard",
		link: route("dashboard"),
		isHome: true,
	},
	{
		label: "Produtos",
		link: route("product.index", {
			orderByField: "name",
			direction: "asc",
		}),
	},
	{
		label: "Cadastro",
	},
];

const data = reactive({ productName: "" });

const slug = computed(() => slugfy(data.productName));
</script>

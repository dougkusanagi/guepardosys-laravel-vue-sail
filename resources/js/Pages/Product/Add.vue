<template>
	<div class="pt-12 px-6">
		<div class="flex mb-2">
			<Breadcrumb :items="breadcrumbs" />
		</div>

		<h1 class="font-bold text-3xl mb-6">Cadastro de Produto</h1>

		<div class="flex space-x-6">
			<div
				class="w-80 h-max hidden flex-col lg:flex rounded-lg space-y-1 sticky top-0"
			>
				<a href="#info" class="btn btn-primary gap-2 justify-start">
					<InformationCircleIcon class="h-5 w-5" />

					<span class="text-white font-normal text-xs">Informações</span>
				</a>

				<a href="#image" class="btn btn-primary gap-2 justify-start">
					<PhotoIcon class="h-5 w-5" />

					<span class="text-white font-normal text-xs">Imagens</span>
				</a>
			</div>

			<div class="w-full">
				<div
					id="info"
					class="flex flex-col space-y-4 bg-white rounded-lg p-4 mb-6"
				>
					<h2 class="text-xl font-bold mb-2">Informações</h2>

					<div class="md:flex md:space-x-4">
						<div class="w-full md:w-1/2">
							<FormInputText
								label="Nome do Produto"
								placeholder="ex: Cartão de visitas"
								name="name"
								type="search"
								v-model="data.productName"
								v-focus
							/>
						</div>

						<div class="w-full md:w-1/2">
							<FormInputText
								label="Slug"
								placeholder="ex: cartao-de-visitas"
								name="slug"
								type="search"
								v-model="slug"
							/>
						</div>
					</div>

					<div class="md:flex md:space-x-4">
						<div class="w-full md:w-1/3">
							<FormInputText
								label="Preço"
								type="number"
								placeholder="ex: 19.98"
								name="price"
								min="0"
								step="0.01"
							/>
						</div>

						<div class="w-full md:w-1/3">
							<label>
								<span class="block text-slate-500 font-bold mb-2">Modelo</span>
								<FormSelect
									:options="product_model_prefixes"
								/>
							</label>
						</div>

						<div class="w-full md:w-1/3">
							<label>
								<span class="block text-slate-500 font-bold mb-2">Status</span>
								<FormSelect
									:options="product_status_enum"
								/>
							</label>
							<!-- <label>
								<span
									class="block text-slate-500 font-bold mb-2"
									>Status</span
								>

								<select
									class="select w-full text-slate-700 font-normal placeholder-gray-400 border-gray-300 focus:ring-indigo-600 focus:border-indigo-600"
									id="status"
									name="status"
								>
									<option
										v-for="(
											value, name
										) in product_status_enum"
										:value="value"
										:key="value"
									>
										{{ name }}
									</option>
								</select>
							</label> -->
						</div>
					</div>

					<div class="md:flex md:space-x-4">
						<div class="w-full md:w-1/2">
							<div class="form-control">
								<label class="label" for="description">
									<span class="label-text text-slate-500 font-bold"
										>Descrição Simples</span
									>
								</label>

								<textarea
									class="textarea textarea-bordered h-24"
									placeholder="Descrição simples"
									id="description"
									name="description"
								></textarea>
							</div>
						</div>

						<div class="w-full md:w-1/2">
							<div class="form-control">
								<label class="label" for="description_html">
									<span class="label-text text-slate-500 font-bold"
										>Descrição HTML</span
									>
								</label>

								<textarea
									class="textarea textarea-bordered h-24"
									placeholder="Descrição HTML"
									id="description_html"
									name="description_html"
								></textarea>
							</div>
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
import { reactive, computed } from "vue";
import { slugfy } from "@/helpers/string";
import Breadcrumb from "@/Components/Breadcrumb.vue";
import FormInputText from "@/Components/Form/FormInputText.vue";
import FormInputGroup from "@/Components/Form/FormInputGroup.vue";
import FormSelect from "@/Components/Form/FormSelect.vue";
import InformationCircleIcon from "@/Icons/InformationCircle.vue";
import PhotoIcon from "@/Icons/Camera.vue";
import Refresh from "@/Icons/Refresh.vue";

defineProps({
	product_model_prefixes: Array,
	product_status_enum: Array,
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
		label: "Cadastro",
	},
];

const data = reactive({ productName: "" });

const slug = computed(() => slugfy(data.productName));
</script>

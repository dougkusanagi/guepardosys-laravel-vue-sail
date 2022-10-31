<template>
	<file-pond
		ref="filepond_ref"
		@init="handleFilePondInit"
		@processfile="handleFilePondProcess"
		@removefile="handleFilePondRemoveFile"
	/>
</template>

<script setup>
import { ref } from "vue";
import vueFilePond, { setOptions } from "vue-filepond";
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
import FilePondPluginImagePreview from "filepond-plugin-image-preview";
import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css";
import "filepond/dist/filepond.min.css";

const props = defineProps({
	form: Object,
	csrf_token: String,
});

const filepond_ref = ref(0);

defineExpose({ filepond_ref });

const FilePond = vueFilePond(
	FilePondPluginFileValidateType
	// FilePondPluginImagePreview,
);

const handleFilePondInit = function () {
	setOptions({
		credits: true,
		server: {
			url: "/filepond",
			headers: { "X-CSRF-TOKEN": props.csrf_token },
		},
	});
};

const handleFilePondProcess = function (error, file) {
	props.form.filepond_files.push({ id: file.id, serverId: file.serverId });
};

const handleFilePondRemoveFile = function (error, file) {
	props.form.filepond_files = props.form.filepond_files.filter(
		(item) => item.id !== file.id
	);
};

props.form.transform((data) => {
	return {
		...data,
		filepond_files: data.filepond_files.map((item) => item.serverId),
	};
});
</script>

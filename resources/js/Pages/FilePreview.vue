<template></template>
<script setup>
const { fileMimeType, rawFile, shouldDownload } = defineProps({
    rawFile: {
        type: String,
        required: true,
    },
    fileMimeType: { type: String, required: true },
    shouldDownload: { type: Boolean, required: false, defaut: false },
});

alert(
    "Por favor, habilite o uso de popups neste site para seu correto funcionamento."
);

if (!shouldDownload) {
    const previewWindow = window.open("", "_blank");

    previewWindow.document.writeln(`
        <style>
            html,
            *,
            body {
                padding: 0;
                margin:0;
            }
        </style>
        <embed type="${fileMimeType}" src="data:${fileMimeType};base64,${rawFile}" height="100%" width="100%" />
    `);
}

window.open(`data:${fileMimeType};base64,${rawFile}`, "_blank");
</script>

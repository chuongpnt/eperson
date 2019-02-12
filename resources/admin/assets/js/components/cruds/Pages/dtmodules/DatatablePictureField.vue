<template>
    <div v-html="row.picture_link"></div>
</template>


<script>
    export default {
        props: ['row'],
    }
</script>

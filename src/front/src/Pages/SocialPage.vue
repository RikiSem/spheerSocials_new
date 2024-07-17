<template>
    <social-page-component>
        <my-feed></my-feed>
    </social-page-component>
</template>

<script>
import SocialPageComponent from "../Components/SocialPageComponent.vue";
import MyFeed from "../Components/MyFeed.vue";
export default {
    name: "SocialPage",
    components: {MyFeed, SocialPageComponent}
}
</script>

<style scoped>

</style>

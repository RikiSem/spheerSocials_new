<template>
    <main-template>
        <template v-slot:navbar>
            <nav-bar>
                <template v-slot:header>
                    <my-header></my-header>
                </template>
                <template v-slot:content>
                    <my-button @click="$router.push(`/user/${ $route.params.userId }/settings`)">Профиль</my-button>
                    <my-button @click="$router.push(`/user/${ $route.params.userId }/socials`)">Сообщества</my-button>
                    <my-button v-if="this.$store.state.user.isAdmin">Админка</my-button>
                </template>
            </nav-bar>
        </template>
        <template v-slot:content>
            <slot></slot>
        </template>
    </main-template>
</template>

<script>
import axios from "axios";

export default {
    name: "UserPageComponent",
}
</script>

<style scoped>

</style>

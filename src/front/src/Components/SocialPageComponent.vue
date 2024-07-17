<template>
    <main-template>
        <template v-slot:navbar>
            <nav-bar>
                <template v-slot:header>
                    <my-header></my-header>
                </template>
                <template v-slot:content>
                    <my-button @click="$router.push(`/social/${ $route.params.id }/${ $route.params.userId }/search`)">Поиск</my-button>
                    <my-button @click="$router.push(`/social/${ $route.params.id }/${ $route.params.userId }/feed`)">Лента</my-button>
                    <my-button @click="$router.push(`/social/${ $route.params.id }/${ $route.params.userId }/groups`)">Группы</my-button>
                    <my-button @click="$router.push(`/social/${ $route.params.id }/${ $route.params.userId }/friends`)">Друзья</my-button>
                    <my-button @click="$router.push(`/social/${ $route.params.id }/${ $route.params.userId }/chats`)">Чаты</my-button>
                    <my-button @click="$router.push(`/social/${ $route.params.id }/${ $route.params.userId }/settings`)">Настройки</my-button>
                </template>
            </nav-bar>
        </template>
        <template v-slot:content>
            <div class="socialPageContent">
                <slot></slot>
            </div>
        </template>
    </main-template>
</template>

<script>
export default {
    name: "SocialPageComponent"
}
</script>

<style scoped>
.socialPageContent{
    width: 100%;
    display: flex;
    flex-direction: column;
}
</style>

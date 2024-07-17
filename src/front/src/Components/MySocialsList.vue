<template>
    <div class="list" v-for="item in items">
        <list-item class="listItem">
            <div class="listItemContent">
                <span class="socialName">
                    {{ item.name }}/
                </span>
                <span> / </span>
                <span class="socialDescription">
                    {{ item.description }}
                </span>
                <div v-if="item.isJoinedUser || !item.hasOwnProperty('isJoinedUser')">
                    <my-button @click="$router.push(`/social/${ item.id }/${ $route.params.userId }/feed`)">Войти</my-button>
                </div>
                <div v-else>
                    <my-button-red @click="$emit('joinSocial', item.id)">Присоединиться</my-button-red>
                </div>
            </div>
        </list-item>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "MySocialsList",
    props:{
        items:{
            type: Array,
            required: true
        }
    }
}
</script>

<style scoped>

.listItemContent{
    overflow-x: hidden;
    overflow-y: hidden;
    display: flex;
}
.socialName, .socialDescription{
    width: 100%;
}

.list{
    width: 100%;
    overflow-y: scroll;
}
.list::-webkit-scrollbar{
    display: none;
}
</style>

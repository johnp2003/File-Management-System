<template>
    <div class="header-container p-2" style="width: 100%; display: flex; align-items: center; justify-content: space-between;">
      <div @click="$router.go(-1)" class="back-button" style="width: 40px; height: 40px; cursor: pointer; display: flex; align-items: center; justify-content: center;">
        <i class="fa fa-chevron-left" aria-hidden="true"></i>
      </div>
      <div class="title-container" style="flex-grow: 1; text-align: center;">
        <p class="text-center mt-1 font-semibold" style="margin: 0;">
          {{ currentTitlePage }}
        </p>
      </div>
      <div class="search-button" style="width: 40px; height: 40px; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 130%;" v-if="isFolderPage">
        <router-link :to="{name: 'FileSearch'}">
        <i class="fa fa-search" aria-hidden="true"></i>
        </router-link>
      </div>
      <div class="search-button" style="width: 40px; height: 40px;float:left; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 130%;" v-if="!isFolderPage">
        <router-link :to="{name: 'FolderEdit'}">
        <i class="fa fa-cog" aria-hidden="true"></i>
        </router-link>
    </div>
    </div>
    <router-view></router-view>
  </template>
  
  <script>
  export default {
    data() {
      return {
        formData: {
          name: ""
        }
      };
    },
    computed: {
      currentTitlePage() {
        return this.$route?.meta?.title || "";
      },
      isFolderPage(){
        return this.$route?.meta?.title == "File List" ? false : true;
      }
    }
  };
  </script>
  
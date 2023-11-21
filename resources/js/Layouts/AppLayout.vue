<script setup>
import { ref } from "vue";
import { Head, Link, router } from "@inertiajs/vue3";
import ApplicationMark from "@/Components/ApplicationMark.vue";
import Banner from "@/Components/Banner.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";

defineProps({
  title: String,
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
  router.put(
    route("current-team.update"),
    {
      team_id: team.id,
    },
    {
      preserveState: false,
    }
  );
};

const logout = () => {
  router.post(route("logout"));
};

const leftDrawerOpen = ref(false);

const toggleLeftDrawer = () => {
  leftDrawerOpen.value = !leftDrawerOpen.value;
};
</script>

<template>
  <q-layout view="hHh lpR fFf">
    <!-- Page Heading -->
    <!-- <header v-if="$slots.header" class="bg-white shadow">
          <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        
          </div>
        </header> -->

    <q-header elevated class="bg-primary text-white" height-hint="98">
      <q-toolbar>
        <q-btn dense flat round icon="menu" @click="toggleLeftDrawer" />

        <q-toolbar-title>
          <q-avatar>
            <img src="https://cdn.quasar.dev/logo-v2/svg/logo-mono-white.svg" />
          </q-avatar>
          {{ title ?? "Dashboard" }}
        </q-toolbar-title>
      </q-toolbar>
    </q-header>

    <!-- Page Content -->

    <q-drawer show-if-above v-model="leftDrawerOpen" side="left" bordered>
      <!-- Responsive Navigation Menu -->
      <div class="mt-3 space-y-1">
        <ResponsiveNavLink
          :href="route('dashboard')"
          :active="route().current('dashboard')"
        >
          Dashboard
        </ResponsiveNavLink>



        <ResponsiveNavLink
          :href="route('document')"
          :active="route().current('document')"
        >
          Documents
        </ResponsiveNavLink>


        <q-separator/>
        <ResponsiveNavLink
          :href="route('profile.show')"
          :active="route().current('profile.show')"
        >
          Profile
        </ResponsiveNavLink>

        <ResponsiveNavLink
          v-if="$page.props.jetstream.hasApiFeatures"
          :href="route('api-tokens.index')"
          :active="route().current('api-tokens.index')"
        >
          API Tokens
        </ResponsiveNavLink>

        <!-- Authentication -->
        <form method="POST" @submit.prevent="logout">
          <ResponsiveNavLink as="button"> Log Out </ResponsiveNavLink>
        </form>

        <!-- Team Management -->
        <template v-if="$page.props.jetstream.hasTeamFeatures">
          <div class="border-t border-gray-200" />

          <div class="block px-4 py-2 text-xs text-gray-400">Manage Team</div>

          <!-- Team Settings -->
          <ResponsiveNavLink
            :href="route('teams.show', $page.props.auth.user.current_team)"
            :active="route().current('teams.show')"
          >
            Team Settings
          </ResponsiveNavLink>

          <ResponsiveNavLink
            v-if="$page.props.jetstream.canCreateTeams"
            :href="route('teams.create')"
            :active="route().current('teams.create')"
          >
            Create New Team
          </ResponsiveNavLink>

          <!-- Team Switcher -->
          <template v-if="$page.props.auth.user.all_teams.length > 1">
            <div class="border-t border-gray-200" />

            <div class="block px-4 py-2 text-xs text-gray-400">
              Switch Teams
            </div>

            <template
              v-for="team in $page.props.auth.user.all_teams"
              :key="team.id"
            >
              <form @submit.prevent="switchToTeam(team)">
                <ResponsiveNavLink as="button">
                  <div class="flex items-center">
                    <svg
                      v-if="team.id == $page.props.auth.user.current_team_id"
                      class="me-2 h-5 w-5 text-green-400"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                      />
                    </svg>
                    <div>{{ team.name }}</div>
                  </div>
                </ResponsiveNavLink>
              </form>
            </template>
          </template>
        </template>
      </div>
    </q-drawer>
   
          <main class="">
            <slot />
          </main>
   
  </q-layout>
</template>

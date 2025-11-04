<script setup lang="ts">
import { useI18n } from "vue-i18n"
import { PopularArtistsList } from "@/widgets/artist/popular-artists-list"
import { MediaSection } from "@/shared/ui"

const { t } = useI18n()
</script>

<template>
    <media-section
        :title="t('page.home.section-title.popular-artists')"
    >
        <popular-artists-list
            one-row
        />
    </media-section>
</template>

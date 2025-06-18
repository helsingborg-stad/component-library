@include('Person.views.components.simple.image')

@include('Person.views.components.simple.details')

@include('Person.views.components.simple.contact')

<style>
    .c-person--simple .c-person__contact .c-button {
        min-width: 0;
        height: auto;
    }

    .c-person--simple .c-person__image {
        aspect-ratio: 1 / 1;
    }

    .c-person--simple .c-person__image img {
        height: 100%;
        object-fit: cover;
        width: 100%;
    }

    .c-person--simple .c-avatar {
        aspect-ratio: 1 / 1;
        border-radius: 0;
        height: 100%;
        width: 100%;
    }
</style>

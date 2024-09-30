<x-layout>
    <x-slot:heading>
        Job Listings
    </x-slot:heading>

    <h2>{{ $job['title']}}</h2>
    <p>
        This jobs play {{$job['salary']}}
    </p>
</x-layout>
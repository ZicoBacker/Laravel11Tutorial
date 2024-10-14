<x-layout>
    <x-slot:heading>
        Job Listings
    </x-slot:heading>

    <h2>{{ $job->title}}</h2>
    <p>
        This jobs play {{$job->salary}}
    </p>

    <p>
        <x-button href="/jobs/{{$job->id}}/edit">Edit Job</x-button> 
    </p>
</x-layout>
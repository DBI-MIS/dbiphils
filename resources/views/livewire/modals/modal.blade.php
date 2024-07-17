<x-modal-wrapper wire:model='visible'>

    <livewire:create-job-response
    :post_title="$job->id" 
    :date_response="Carbon\Carbon::now()->format('M-d-Y')"
    />

</x-modal-wrapper>

<!-- Navigation Links -->
<div class="w-full flex flex-col gap-5 p-4">
    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
    </x-nav-link>

    <x-nav-link :href="route('agencies.index')" :active="request()->routeIs('agencies.index')">
        {{ __('Agencies') }}
    </x-nav-link>

    <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">
        {{ __('Users') }}
    </x-nav-link>

    <x-nav-link :href="route('indicators.index')" :active="request()->routeIs('indicators.index')">
        {{ __('Primary Indicators') }}
    </x-nav-link>

    <x-nav-link :href="route('evaluate_indicators.index')" :active="request()->routeIs('evaluate_indicators.index')">
        {{ __('Evaluate Indicators') }}
    </x-nav-link>

    <x-nav-link :href="route('select_draft_indicators.index')" :active="request()->routeIs('select_draft_indicators.index')">
        {{ __('Select Draft') }}
    </x-nav-link>

    <x-nav-link :href="route('draft_indicators.index')" :active="request()->routeIs('draft_indicators.index')">
        {{ __('Draft Indicators') }}
    </x-nav-link>

    <x-nav-link :href="route('submit_draft_indicators.index')" :active="request()->routeIs('submit_draft_indicators.index')">
        {{ __('Submit Draft') }}
    </x-nav-link>

    <x-nav-link :href="route('pending_submission.index')" :active="request()->routeIs('pending_submission.index')">
        {{ __('Pending for Submission') }}
    </x-nav-link>

    <x-nav-link :href="route('initial_approval.index')" :active="request()->routeIs('initial_approval.index')">
        {{ __('Pending for Approval (SYSAD)') }}
    </x-nav-link>

    <x-nav-link :href="route('classify_indicators.index')" :active="request()->routeIs('classify_indicators.index')">
        {{ __('Classify Indicators') }}
    </x-nav-link>

    <x-nav-link :href="route('final_approval.index')" :active="request()->routeIs('final_approval.index')">
        {{ __('Pending for Approval (DIRECTOR)') }}
    </x-nav-link>
</div>

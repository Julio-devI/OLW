<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="px-4 sm:px-6 lg:px-8">

                <x-heading 
                title="Sales" 
                description="A list of all the sales."  
                />
                <div class="w-full overflow-hidden md:rounded-lg">
                    <livewire:table
                        resource="Sale"
                        :columns="[
                        ['label' => 'Seller', 'column' => 'seller.user.name'],
                        ['label' => 'Client','column' => 'client.user.name'],
                        ['label' => 'Sold_at', 'column' => 'sold_at'],
                        ['label' => 'status', 'column' => 'status'],
                        ['label' => 'Total_amount', 'column' => 'total_amount'],
                    ]
                    "
                        edit="clients.edit"
                        delete="clients.destroy"
                    ></livewire:table>
                </div>

        </div>
    </div>
</x-app-layout>
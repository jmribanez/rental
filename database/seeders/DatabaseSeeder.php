<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        /**
         * Starting ideas:
         * USERS (ROLES) :
         * - Administrator  -> can manage all models, probably best for person who manages server.
         * - Landlord       -> can manage properties, tenants, billing (invoice), transactions, and contracts.
         *                     can review system and audit trails.
         * - Cashier        -> can perform collections and disbursements, issue invoice, view property data,
         *                     view tenant data.
         * - Tenant         -> can view leased property information, view bills, settle bills, view contract.
         * 
         * MODELS :
         * [User]
         *      - id, first_name, last_name, email, password, contact_number, address, photo, legal_id_photo, 
         *          role*, properties (belongsToMany to determine landlord).
         * [Property]
         *      - id, name, address, landlords (user: belongsToMany), utilities (belongsToMany), 
         *          contracts (hasMany)
         * [PropertyUser]
         *      - property_id, user_id
         * [Utility]
         *      - id, name, address, contact_number, type
         * [Property-Utility]
         *      - property_id, utility_id, subscription_number
         * [Contract]
         *      - id, date, policy, date_start, date_end, invoice_day, security_deposit, rental_amount, 
         *          agreed_payment_mode, scanned_contract, property (belongsTo), tenant (user: belongsTo)
         * [Invoice]
         *      - id, date, contract (belongsTo), particulars (item, amount in json format), total_amount
         * [Transaction]
         *      - id, date, contract (belongsTo, optional), flow [in/out/transfer], account (belongsTo), 
         *          particulars (item, amount in json format), total_amount, reference_number
         * [Account]
         *      - id, name [Cash, GCash, Check, Bank, Payable, Receivable], account_number (optional), transactions (hasMany)
         * 
         * BUSINESS RULES :
         *      -> properties can have more than one landlord.
         *      -> transactions cannot be deleted - can only be voided / canceled.
         *          - When a transaction is canceled, it should record who voided / canceled it.
         *      -> users cannot be deleted - only soft deleted, for audit trailing.
         *          - When a tenant is cleared from a property, they are soft deleted. Comment required.
         *      -> properties cannot be deleted - only soft deleted, for audit trailing.
         *          - When a property is removed by a landlord, it should have a comment why.
         * 
         * CONSIDERATIONS:
         *      -> Mobile-first interface
         *      -> No need for e-payment gateway
         *      -> needs HTTPS
         *      -> align with client corporate identity, this is a real real estate company
         *      -> will likely need a domain
         *      -> system must be production-ready, remove debug code on staging
         */

        // Role creation
        $rAd = Role::create(['name' => 'Administrator']);
        $rLa = Role::create(['name' => 'Landlord']);
        $rCa = Role::create(['name' => 'Cashier']);
        $rTe = Role::create(['name' => 'Tenant']);

        // User permissions
        Permission::create(['name' => 'list users'])->syncRoles([$rAd, $rLa, $rCa]);
        Permission::create(['name' => 'create user'])->syncRoles([$rAd]);
        Permission::create(['name' => 'edit user'])->syncRoles([$rAd]);
        Permission::create(['name' => 'view user'])->syncRoles([$rAd, $rLa, $rCa]);
        Permission::create(['name' => 'delete user'])->syncRoles([$rAd]);
        Permission::create(['name' => 'view self'])->syncRoles([$rAd, $rLa, $rCa, $rTe]);

        // Property permissions
        Permission::create(['name' => 'list properties'])->syncRoles([$rAd, $rLa, $rCa]);
        Permission::create(['name' => 'create property'])->syncRoles([$rAd, $rLa]);
        Permission::create(['name' => 'edit property'])->syncRoles([$rAd, $rLa]);
        Permission::create(['name' => 'view property'])->syncRoles([$rAd, $rLa, $rCa]);
        Permission::create(['name' => 'delete property'])->syncRoles([$rAd, $rLa]);

        // PropertyUser permissions
        Permission::create(['name' => 'set propertyuser'])->syncRoles([$rAd, $rLa]);
        Permission::create(['name' => 'unset propertyuser'])->syncRoles([$rAd, $rLa]);

        // Utility permissions
        Permission::create(['name' => 'create utility'])->syncRoles([$rAd, $rLa]);
        Permission::create(['name' => 'edit utility'])->syncRoles([$rAd, $rLa]);
        Permission::create(['name' => 'view utility'])->syncRoles([$rAd, $rLa, $rCa, $rTe]);
        Permission::create(['name' => 'delete utility'])->syncRoles([$rAd, $rLa]);

        Permission::create(['name' => 'set propertyutility'])->syncRoles([$rAd, $rLa]);
        Permission::create(['name' => 'unset propertyutility'])->syncRoles([$rAd, $rLa]);

        // Contract permissions
        Permission::create(['name' => 'create contract'])->syncRoles([$rAd, $rLa]);
        Permission::create(['name' => 'edit contract'])->syncRoles([$rAd, $rLa]);
        Permission::create(['name' => 'view contract'])->syncRoles([$rAd, $rLa, $rCa, $rTe]);
        Permission::create(['name' => 'delete contract'])->syncRoles([$rAd, $rLa]);

        // Invoice permissions
        Permission::create(['name' => 'create invoice'])->syncRoles([$rAd, $rLa, $rCa]);
        Permission::create(['name' => 'edit invoice'])->syncRoles([$rAd, $rLa]);
        Permission::create(['name' => 'view invoice'])->syncRoles([$rAd, $rLa, $rCa, $rTe]);
        Permission::create(['name' => 'cancel invoice'])->syncRoles([$rAd, $rLa]);

        // Transaction permissions
        Permission::create(['name' => 'create transaction'])->syncRoles([$rAd, $rLa, $rCa]);
        Permission::create(['name' => 'edit transaction'])->syncRoles([$rAd, $rLa]);
        Permission::create(['name' => 'view transaction'])->syncRoles([$rAd, $rLa, $rCa, $rTe]);
        Permission::create(['name' => 'cancel transaction'])->syncRoles([$rAd, $rLa]);

        // Account permissions
        Permission::create(['name' => 'create account'])->syncRoles([$rAd, $rLa]);
        Permission::create(['name' => 'edit account'])->syncRoles([$rAd, $rLa]);
        Permission::create(['name' => 'view account'])->syncRoles([$rAd, $rLa]);
        Permission::create(['name' => 'close account'])->syncRoles([$rAd, $rLa]);

        // Create root account
        $user1 = User::factory()->create([
            'name_last' => 'User',
            'name_first' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('abc.123'),
        ]);
        $user1->assignRole($rAd);

        // Create dummy accounts
        $user2 = User::factory()->create([
            'name_last' => 'Nepomuceno',
            'name_first'=> 'Juan',
            'email' => 'landlord@mail.com',
            'password' => Hash::make('abc.123'),
        ]);
        $user2->assignRole($rLa);

        $user3 = User::factory()->create([
            'name_last' => 'Lazatin',
            'name_first'=> 'Carmelo',
            'email' => 'cashier@mail.com',
            'password' => Hash::make('abc.123'),
        ]);
        $user3->assignRole($rCa);

        $user4 = User::factory()->create([
            'name_last' => 'Garbo',
            'name_first'=> 'Cris',
            'email' => 'tenant1@mail.com',
            'password' => Hash::make('abc.123'),
        ]);
        $user4->assignRole($rTe);
    }
}

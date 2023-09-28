# LaraTickets

**LaraTickets** is a support portal that enables users to log their complains. The system is expected to have three types of users, admins, support agents and complainants or the users.

#### Key Features

1. All users types should be able to login to the system and view their respective dashboards.
2. The complainants should be able to raise a ticket, which will allow the agents attend to it.
3. The agents should be able to respond to the tickets.
4. There should be a reply feature on the tickets for both users and agents.
5. An admin can create agents and manage them.
6. Only users (complainants) can register an account.
7. A ticket should have a tracking ID
8. Agents cannot manage other agents account or even be aware there's a section for agents management on the system.
9. Agents should be able to filter the complains or tickets using ticket ID and/or other means of filtering.
10. All users types should be able to update their.
11. Admin users should be created via web or command line interface

Normalize the use of core Laravel features such as Pagination, Gates, Commands, Eloquent eager loading etc. Using these advanced features can greatly impact our decision.

### Good Luck!

# How to use my solution

1. Pull the current codebase.
2. Configure Email Client in .env file (e.g. mailhog, Mailtrap) to recieve temporary login details
3. Run Migration
4. Seed Database to create Ticket Departments
    ```bash
        php artisan db:seed
    ```
5. Create new admin with the command the following command 
    ```bash
        php artisan create:user {name of user} {The email of the user} {The user role can either be admin, user or agent}
    ```
6. 
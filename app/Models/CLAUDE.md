# Models Documentation

This directory contains Eloquent models that represent database tables and define relationships.

## Models

### `User.php`

The main user model with authentication and approval functionality.

#### Key Properties:
- `name` - User's display name
- `email` - Unique email address
- `password` - Hashed password
- `is_approved` - Boolean flag for approval status
- `is_super_admin` - Boolean flag for admin privileges
- `approved_at` - Timestamp of approval
- `approved_by` - ID of admin who approved

#### Methods:

##### Authorization Methods:
- `isApproved()` - Checks if user has been approved
- `isSuperAdmin()` - Checks if user has super admin privileges
- `canApproveUsers()` - Alias for isSuperAdmin()

##### Relationship Methods:
- `approver()` - BelongsTo relationship with the admin who approved this user
- `approvedUsers()` - HasMany relationship with users this admin has approved

##### Business Logic:
- `approve(User $approvedBy)` - Marks user as approved with timestamp and approver

#### Traits:
- `HasFactory` - Enables model factories for testing
- `Notifiable` - Enables notifications
- Laravel's authentication traits

#### Attributes:
- Password is automatically hashed when set
- `email_verified_at` and `remember_token` are hidden from JSON
- Dates are cast appropriately

## Database Schema

The User model corresponds to the `users` table with these key columns:
- Standard Laravel auth columns (name, email, password, etc.)
- `is_approved` (boolean, default: false)
- `is_super_admin` (boolean, default: false)
- `approved_at` (timestamp, nullable)
- `approved_by` (foreign key to users.id, nullable)

## Usage Examples

```php
// Check if user can access approved-only features
if ($user->isApproved()) {
    // Allow access
}

// Approve a user
$user->approve($adminUser);

// Get all users approved by an admin
$admin->approvedUsers()->get();
```

## Future Models

As the application grows, additional models may include:
- `Word` - For storing Danish-English word pairs
- `Game` - For tracking game sessions
- `Score` - For storing user game scores
- `Lesson` - For structured learning content
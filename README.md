# Development Log

## Commits

-   `(20/jun 01:32am)` Init new repo with jetstream and modified styles and navbar
-   `(20/jun 11:50pm)` Registration from old project migrated properly
-   `(20/jun 11:51pm)` Major part of main feed design completed, several components modified
-   `(21/jun 00:57am)` Created Controllers for top pages mapped navigation
-   `(30/jun 09:31am)` Working demo is completed
-   `(30/jun 09:45am)` Addded ability to add images in CKEditor
-   `(30/jun 11:56am)` Social Share added
-   `(01/jul 00:32am)` Added comments with pagination for post and comments and replaced FeedController with FeedPage component

## :rocket: Feature List

### Admin Panel

-   Login: Separate Login for administrator of the website
    -   Make a duplicate login (For normal users)
    -   Change url for admin
-   Dashboard: Dashboard showing quick overview like orders and new orders and post count, etc.
-   Manage: Users Manage all the users on you website suspend someone if wanted or delete
-   Manage Admins: Create and manage other admin accounts to accompany moderation of the website
-   View Orders: View newly came orders and old orders and respond to them or reject them
-   Reports: Download users, orders, posts, etc. data as excel for business use or anything
-   Manage Products: Add, edit or delete products with images and their description or put products on sale to attract customers.
-   Moderate Posts: Ability to hide or delete any posts on entire website without post creators approvals
-   Moderate Reviews: Hide/Delete any reviews if needed
-   Active User Report: Keep track of user login activity

### Main Website

-   Home Page: Home Page will contain latest posts and latest products.
    -   Received there wire-frame image from them on telegram.
    -   Discuss the layout
-   Static Pages(up-to 6 pages): Static Pages like Home, About us, Privacy Policy, Terms & Conditions, Contact Us etc. up-to 6 pages. Some information will be editable by admin.
    -   Get the content of all the pages

### Account Section

-   Login/ Sign Up: Login and Sign Up for social media and shop
-   Dashboard: Statistics related to account like order status/ posts updates/ new comments can be seen here (User Reports)
-   Appreciated/ Bookmarked Posts: All the appreciated and bookmarked posts will added here
-   Orders: Track your order and download anytime if its an software product generate a invoice if needed or share on other website
-   Profile: Profile page containing your posts too all to view and follow your content and for you to edit your details

### Social Media

-   Posts Page(Feed): All the latest posts published can be seen here or follow only posts like a Feed
-   Posts View Page: When clicked posts title entire posts will be loaded and all the content written can be seen and few actions can be taken on posts mentioned below:
-   Appreciate: Readers can appreciate posts if appreciated posts will be added to readers appreciated list
-   Comment: Ability to comment on posts by the readers to ask questions or thanks for content as their heart desire
-   Share: Share this posts on other platforms like WhatsApp, facebook, etc.
-   Bookmark: Readers can bookmark posts which then can be seen inside there bookmark tab on account page
-   Search: Search through posts title and tags to find particular posts easily
-   Follow: Follow creators so next time they add posts readers following them will receive there posts on top of there feed.

### Features for the Post publishers

-   Create Posts: Create posts with title, description and body either or of the last two can be added. Posts can also be tagged by user for better search results, with ability upload documents
-   Manage Posts/ Moderate: Ability to Update/Delete your posts also Moderate like delete comment on your own posts
-   Tag: Ability to tag posts with custom tags which can be created by users
-   Reports/Statistics: See reader count of posts and appreciation count, comments count and all these statistics to understand your audience better and to write better content in future

### Shop Module (Books & Softwares)

-   View listing of products Books and Softwares will be appear on there separate pages listing there name and price and discount if any
-   View product details: Clicking on product will bring you to the product page where users can see images of product and read description if they like it they can purchase the product by clicking on Buy now button
-   Reviews: Customers who purchased product can review on the product for others to see
-   Free Products: Free software can be added to users profile without redirecting payment gateway and can be downloaded anytime.
-   Payment Gateway: Integration of RazorPay payment gateway in the website to for purchasing books and softwares
-   Share Products: Share products on other websites

## :pencil: Previous Project Commits

-   `(09/jun 05:30pm)` Added Complete Feature List
-   `(19/jun 10:20am)` Added details in registration form, enabled profile photo

## Scratch Code

```php
public function publish(?Post $post, PostRequest $request): RedirectResponse
{
    $post->fill($request->merge([
        'user_id' => auth()->id(),
    ])->all())->save();

    Alert::success('Published posts successfully on ' . $post->updated_at->format('d-M-Y h:i'));

    return redirect()->back();
}
```

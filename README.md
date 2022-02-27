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
-   `(08/jul 10:40pm)` Finalized register
-   `(08/jul 10:40pm)` Added User card and follow system
-   `(09/jul 08:58pm)` Added ability to like and count on like & comment, added index in previous migrations
-   `(09/jul 10:55pm)` Added explore page and feed page logic, post appearance modifications, removed default grid component height
-   `(12/jul 12:55pm)` Image type post upload added, youtube embed with ckeditor fixed, Added terms and conditions, and few final touchups, increased ckeditor height, fixed marquee animation.
-   `(12/jul 11:30pm)` Fixed minor bugs when not authenticated, changed post title limit to 500, latest comment always appear under post
-   `(13/jul 02:10pm)` Update profile page completed
-   `(13/jul 11:20pm)` removed create-fab, header image for article, Ckeditor removing spaces fixed, rendering new line in posts, image caption on top, auto-growing post textarea
-   `(16/jul 01:15pm)` Edit/Delete Post, Post Policy, Replaced FeedPage and ExplorePage Components with single PostList, Added SweetAlert, profession under name in profile card
-   `(16/jul 05:35pm)` Replaced profile with PostList Component, Article title have 2 max line now, Article image upload showing broken image in edit when no image uploaded fixed
-   `(16/jul 07:56pm)` Search for posts added, Liking, commenting does not touches updated_at
-   `(21/jul 08:45pm)` Search for users added, Max-height in full article removed.
-   `(22/jul 06:48pm)` Bottom Navigation for small screens only added, removed responsive nav on small screens
-   `(23/jul 03:58pm)` Profile: User Card, Edit profile option, Statistics (Points, Posts, Followers, Followings), Bio instead in profession in small user profile, right side widgets into components, moved large footer to edit profile only and few links addded in right section.
-   `(23/jul 04:30pm)` Followers and Followings pages added
-   `(23/jul 04:50pm)` Social Share Image and description added
-   `(24/jul 11:20am)` Bookmarks Added, Side Nav Added
-   `(24/jul 01:55pm)` Changes from tushar: Image Enlargement on click, copy link button in sharing
-   `(28/jul 09:05am)` Changes: Post time in date instead of diff, Change Publish text to Post, Hide Sharing Buttons, create fab in center, create button top, 1 Point on like
-   `(29/jul 06:25pm)` User Discover Tab
-   `(01/aug 08:14am)` Views on posts, Single post also loads using PostList
-   `(03/aug 06:28pm)` Admin Dashboard: Middleware, Dashboard buttons Admin Menu and view permissions
-   `(06/aug 03:50pm)` Fixed Bookmark button pushing post-nav out of bound
-   `(08/aug 02:25pm)` User Administration, Post Administration
-   `(08/aug 10:00pm)` Website News edit option
-   `(10/aug 12:10pm)` Tax Calendar Add/Edit/Delete/Table option, Added datepicker
-   `(10/aug 03:50pm)` Tax Calendar Widget
-   `(10/aug 07:30pm)` Mobile Hidden widget accessible by button (mobile only), fixed x-on bug in tax calendar
-   `(12/aug 11:30am)` Categories and Share options for tax calendar
-   `(12/aug 07:45pm)` Icons for admin pages, Hidden columns, excludes, exports, ability to delete users
-   `(13/aug 02:10pm)` Post Attachments added
-   `(17/aug 07:35pm)` Product Add/Edit
    -   Attributes: title, images, price, discount, shortDescription, fullDescription, type(Download, Deliver)
-   `(17/aug 07:35pm)` Product Table
-   `(19/aug 05:35pm)` Storefront, Product Search option
-   `(19/aug 05:35pm)` Individual ProductPage
-   `(19/aug 09:45pm)` Out of stock added in UI, common share component added, Product form displays old images
-   `(26/aug 12:22pm)` Checkout Page, added pin code and shipping notes in product table, changed stock to a number, fixed points given to wrong user.
-   `(27/aug 08:30pm)` Orders generation and saving order, payment integration complete, fixed table not rendering properly.
-   `(27/aug 08:30pm)` Order Confirm and Fail page
-   `(01/sep 05:55pm)` Order History Page on Profile
-   `(06/sep 06:35pm)` Download option for Download products, Receipts downloads
-   `(07/sep 12:40pm)` Admin Order Table, status update for admin, fixed toast not showing on action in admin tables
-   `(07/sep 01:15pm)` Latest Orders on admin dashboard
-   `(07/sep 15:25pm)` Shipping cost option on setting, apply shipping on orders, shipping on receipt, dashboard only displays deliverable latest products now
-   `(20/sep 08:05pm)` Free product option and better validation for products 
-   `(21/sep 07:10pm)` Notification Interface 
-   `(23/sep 07:00pm)` Notifications Table and Order Update Notification and ability to clear notifications
-   `(23/sep 07:50pm)` PostLiked notifications on every 5th+1 like, post-edit icon changed
-   `(26/sep 08:30am)` PostCommented, UserFollowed notification, fixed notifications panel visibility on certain pages and not on some
-   `(29/sep 09:25am)` Latest products underline; Add OTP Alredy Given, Delivered
-   `(29/sep 01:50pm)` Notifications on profile menu in mobile
-   `(29/sep 08:00pm)` Notification Dot and optimize notification query
-   `(10/oct 02:45pm)` Google Analytics Integration
-   `(11/0ct 10:40pm)` Remove unverified accounts from user listing
-   `(12/oct 07:15pm)` Fixed Google Analytics Integration
-   `(17/oct 13:08pm)` Seperate address selection option: Model, Form, Validation, Saving
-   `(18/oct 07:55pm)` Seperate address selection option: Select, Save for billing
-   `(19/oct 02:10pm)` Book and Excel tool download sliders
-   `(19/oct 04:10pm)` Product Review option: Add a review with rating
-   `(19/oct 05:00pm)` Product Review option: view reviews
-   `(19/oct 09:35pm)` Product Review option: See overall rating
-   `(19/oct 10:55pm)` Product Review option: Add review policy
-   `(20/oct 12:05pm)` Continous posts
-   `(20/oct 01:05pm)` Continous posts: Product slider, post views are not on incremented every refresh
-   `(20/oct 02:45pm)` Book and Utility Filter
-   `(24/oct 08:40pm)` Demo software products: Button for demo, contact info after purchase; Changed create button style
-   `(24/oct 09:45pm)` Download count for demo products
-   `(25/oct 11:45am)` Report Post: Option to the report post, store report reason
-   `(25/oct 12:20pm)` Report Post: Option to review the reported posts, dashboard count for reported posts
-   `(25/oct 02:20pm)` Optimize website: ran npm run prod
-   `(29/oct 11:55am)` Can pin and unpin posts now
-   `(29/oct 12:40pm)` See users who liked the post
-   `(31/oct 06:45pm)` Ability to hide products

## Fixes
-   `(25/oct 03:40pm)` Fixed: review policy and ability to review
-   `(25/oct 03:55pm)` Fixed: Can delete review now
-   `(25/oct 09:40pm)` Website design changed
-   `(01/nov 11:35am)` Round discount percentage to 0 decimals
-   `(06/nov 06:30pm)` Round discount percentage to 0 decimals in Product Details
-   `(27/feb 06:10pm)` Updated contact number
-   `(27/feb 06:30pm)` Updated label for Post to Short Update (Only display change)

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

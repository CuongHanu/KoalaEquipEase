  User Story
US01:      User Story For Signing In Into Admin Account On EquipEase: Koala Education Centre
As an Admin, I want to log in to the Managing System with the admin's account; so that I can easily manage all the equipment of the Koala House System.
Acceptance Criteria:
-        [Functions] The system displays a login screen with username and password fields and a forgotten password function.
-        The user must fill in the full user name and password before pressing the "Login" button. If the user presses login when the user does not fill in all the information, there will be a message “Không được để tên hoặc mật khẩu trống”
-        The system authenticates the user credentials against an available database. If the user login successfully, the user will switch to the main management interface.
-        Upon unsuccessful login, the system displays an error message with clear instructions "Tên người dùng hoặc mật khẩu bị sai. Bạn còn + numbers of attempt left ".
-        If the user enters the wrong password or user name more than 5 times, the user's account will be locked, and the user will be navigated to the Forgot Password page to recover.
-        [UI] The login screen should be clear and easy to understand and user-friendly.
-        The system provides visual cues to indicate successful/unsuccessful login attempts.
-        [Performance] The login process and all loading processes should be quick and responsive (< 5 seconds)
US02:     User Story For Forgot password function On EquipEase: Koala Education Centre
As an Admin, I want to retrieve my password easily when I don't remember it; so I don't have to worry when I forget my password and get it back quickly.
Acceptance Criteria:
The system offers a "Forgot Password" link on the login screen.
In the Forgot Password page, the user must enter an email that is associated with his/her account before pressing the "Send" button.
 If the user presses login when the user does not fill in all the information, there will be a message "Không được để email trống"
If the user enters an email that is not associated with his/her account, the system displays the message “Địa chỉ email không hợp lệ"
If the user enters the correct email, the system navigates to the login page. The user receives an email containing information about the new password. A new password contains a String “Koala@” + 3 random numbers (Example: Koala@123) 
The user must log in to the system with a password that matches the new password in his/her email
If the user still enters a password that does not match the new password in his/her email, the user is navigated to  the Forgot Password page 
The password reset process must be quick and efficient (The amount of time to send a new password to the email < 1 minute).
After successfully logging in with a new password that was sent from the system, the admin will change their password by accessing the Admin profile section. (another part)
US03:     User Story For Searching items to each class function On EquipEase: Koala Education Centre
As an administrator, I want to search for information about a specific equipment by entering the device's name or input fields in the search bar to easily find the information I want.

Acceptance Criteria:
The search interface is displayed in an easy-to-see location on the device management page. The search bar at the top of the page: This location helps Admin easily access the search function at all times.
The system supports searching according to the following input fields to search for devices: device name.
When the Admin enters a search keyword, the system will compare the search keyword with data in the database accurately regardless of what the Admin enters:
When moving the mouse to the search icon on the search bar, the color of the box changes slightly differently. 
Uppercase or lowercase letters
"Search" button: When Admin finishes entering search criteria, click the "Search" button to activate the search function.
Search results:
If successful: The system displays a list of devices that match Admin's search criteria.
If failed: The system displays the message: "Không tìm thấy vật phẩm."
The system allows the Admin to review and modify the search criteria that have been entered if necessary.
The list displays detailed information about each device, including device name, device number, device status, date of use, date of repair, and notes.
The system returns search results within the shortest time.

US04:      User Story For Adding items to each class function On EquipEase: Koala Education Centre
As an administrator, I want to be able to add new equipment to the existing database in the classroom. This will allow me to easily add new equipment when it is purchased or add it to each classroom.
Acceptance Criteria:
The "Thêm" button is visible and directly on the main interface displaying detailed classroom information.
The "Thêm" button has a blue color.
When clicking on the "Thêm" button, a pop-up will appear displaying all the detailed information about the equipment the user wants to add. This includes: Tên thiết bị, Số lượng, Tình trạng, Ngày sử dụng, Ngày sửa chữa, Ghi chú. 
The system validates all user input in the pop-up form to ensure it meets specific requirements:
Tên thiết bị [Text Form ] (Mandatory)
Số lượng [Positive Number] (Mandatory)
Tình trạng [Bình thường, Hỏng, Cần bảo trì] (Mandatory)
Ngày sử dụng (Mandatory)
Ngày sửa chữa (Optional)
Ghi chú [Text form](Optional)
The “Số lượng” field accepts only numbers. If the user enters text or special characters, the “Số lượng” field is blank.
If the Admin enters the  “Số lượng” as a negative number, and “ Ngày sử dụng” and “Ngày sửa chữa” being non-existent date or entered uncompletedly, the system will display the message“ Vui lòng nhập vào một giá trị hợp lệ. Trường không hoàn chỉnh hoặc có giá trị không hợp lệ" pointing to the invalid field
When the user leaves the required information blank, the system will display a notification “Please fill out this field” pointing to that blank field.
If the “Tên thiết bị” is edited with a new name that overlaps with a previously added device, the system will display the message "Thiết bị đã tồn tại. Vui lòng kiểm tra lại" and back to the adding pop-ups. "Tên thiết bị" still is blank
The system automatically generates a unique identifier for each equipment entry when saving the new equipment.
The system allows users to cancel the add equipment process by clicking the “Huỷ” red button at the bottom of the pop-up.
After completing all the information, the user will click the "Lưu" green button at the bottom of the pop-up to add the new equipment to the database.
Upon successful addition of new equipment, the system displays a clear confirmation message to the user: “ Thêm thành công”
After successfully adding the information, the information about the new equipment will be displayed in the last position of the information board of each classroom.
If the Admin does not want to add a device, the Admin will click the "Huỷ" red button at the bottom of the pop-up to back to the equipment management interface, and the current information board will remain unchanged without any changes.
US05:      User Story For Editing items to each class function On EquipEase: Koala Education Centre.
As an administrator, I want to edit the information on the existing equipment to ensure that the data about them is always up-to-date and accurate.
Acceptance Criteria:
Admin directly selects the device that needs to edit information on the screen displaying the list of devices or uses the search tool to find the device that needs fixing in case the list of devices in the class is too long.
The ''Sửa'' button must be placed in the right corner of each device row and visible in each class's device management interface.
The ''Sửa'' button must be red to stand out. 
After pressing the ''Sửa'' button, a pop-up screen with the name ''Sửa thông tin thiết bị'' will be displayed. 
The pop-up screen must display all device attributes including: Tên thiết bị, Số lượng, Đơn vị,  Tình trạng, Ngày sử dụng, Ngày hết bảo hành, giá trị,  Ghi chú. 
Each device attribute must be visible and display current information that matches the information on the classroom device management list. 
The admin will directly edit the information for each attribute by clicking on the space displaying the information for each attribute. 
The system will provide the option to edit information when the Admin clicks directly on the information area that needs to be edited.
Options for editing information must comply with the following rules for each device attribute:
Tên thiết bị [Text Form ] (Mandatory)
Số lượng [Positive Number] (Mandatory)
Đơn vị [text](mandatory)
Tình trạng [Bình thường, Hỏng, Cần bảo trì] (Mandatory)
Ngày sử dụng (Mandatory)
Ngày hết bảo hành (Optional)
Giá trị (Mandatory)
Ghi chú [Text form](Optional)
The “Số lượng” field accepts only numbers. If the user enters text or special characters, the “Số lượng” field is blank.
If the Admin enters “Số lượng” as a negative number, and “ Ngày sử dụng” and “Ngày sửa chữa” being non-existent date or entered uncompletedly, the system will display the message“ Vui lòng nhập vào một giá trị hợp lệ. Trường không hoàn chỉnh hoặc có giá trị không hợp lệ" pointing to the invalid field
When the user leaves the required information blank, the system will display a notification “Vui lòng nhập trường này” pointing to that blank field.
If the “Tên thiết bị” is edited with a new name that overlaps with a previously added device, the system will display the message "Vật phẩm đã tồn tại. Vui lòng cập nhật lại" and back to the editing pop-ups, and "Tên thiết bị " still retains the old information
The ''Lưu'' green button and the “Huỷ” red button must be visible below the attributes information panel.
If the information is edited to comply with the editing rules, after the ''Lưu'' button is pressed, a new pop-up screen will be displayed with the message ''Sửa  thành công.’’
After successfully changing the equipment properties information, the system will return the Admin to the device list class management interface and display the information after successful editing.
If the Admin presses the “Huỷ” button, the system will take the Admin back to the equipment management interface, and the current information will remain unchanged without any changes.

US06:     User Story For Deleting items to each class function On EquipEase: Koala Education Centre.
As an administrator, I want to delete the information on the existing equipment to ensure that the data about them is always up-to-date and accurate.
Acceptance Criteria:
The admin directly selects the device that must be deleted on the screen, displaying the list of devices, or uses the search tool to find the device that needs to be deleted if the list of devices in the class is too long.
The ''Xóa'' button must be placed to the right of the “Sửa” button.
After pressing the ''Xoá'' button, a pop-up screen with the name ''Xác nhận xoá + Tên thiết bị”' will be displayed with two buttons: ‘’Xoá’’ and “Huỷ” at the bottom, standing next to each other 
If the user presses the “Hủy” button, the system will take the Admin back to the devices list screen, delete the pop-up screen, cancel the device deleting process, and the device selected to delete will stay unchanged on the devices list (including the ordinal position on the list)
Press the “Xoá” button. The system displays a message " Thiết bị đã được xoá thành công", and that device and its information will disappear.
US07:     User Story For Change the account password  On EquipEase: Koala Education Centre.
As an administrator, I want to change my account password when I want my password to be more secure, or I suspect my password has been leaked.
Acceptance Criteria:’
The change password button must be displayed in a visible location in the user logo icon as a drop-down menu on the user interface. It has a clear label or text that says "Đổi mật khẩu".
All steps are contained in only 1 page (enter current password, enter new password, re-enter new password). 
Current password, new password, and re-entering new password are mandatory. If these fields are blank, the system displays the message "Vui lòng điền vào trường này" pointing to the blank field

Current password: The system prompts the administrator to enter their password.
The current password will be hidden as it's being typed ( using ).
The system validates the current password. If incorrect, the system displays a red error message "Mật khẩu hiện tại không đúng, vui lòng nhập lại”,  indicating the current password is invalid and allow the user to re-enter it.
New Password: The system prompts the administrator to enter a new password.
A message instructing to set a new password format “Mật khẩu mở tối thiểu 6 ký tự riêng biệt, và bao gồm ít nhất 1 chữ cái viết hoa.” will be displayed as soon as the user clicks change password (in the main interface).
The new password field enforces password complexity requirements (at least six letters, including uppercase letters, lowercase letters, numbers, and special characters. Such as Group@12312). If the user enters incorrectly, the system will display a red message: "Mật khẩu mới phải bao gồm ít nhất 6 kí tự gồm chữ cái hoa, chữ cái thường, số và kí tự đặc biệt.”
The system will ask the administrator to confirm the new password by re-entering it below the box to enter the new password. If the user enters the new password incorrectly, the system will notify “Mật khẩu mới không khớp, vui lòng kiểm tra lại.”   and ask the user to re-enter.
The new password entry and The new password re-entry will be displayed as (using ).
"Hoàn tất" green button and "Hủy" red button will be displayed below. When the user completes filling in the information, it is valid. The admin presses the “Hoàn tất” button The system will update the new password and receive a success notification. Pressing the "Huỷ" button will cancel the process and return it to the system.
Display a confirmation message indicating the password change was successful. “Đổi mật khẩu thành công” and the system automatically takes the admin to the login page

US08:     User Story For Logging Out On EquipEase: Koala Education Centre.
As an administrator, I want to log out of the system quickly and easily every time I want to ensure the security and privacy of my account when I'm away from my computer.
Acceptance Criteria:
The admin has successfully logged into the system using the admin account.
Logout button: 
It must be displayed in a visible location in the user logo icon as a drop-down menu on the user interface.
It has a clear label or text that says "Đăng xuất".
The system displays a pop-up screen with a confirmation message including “Có” red button and “Huỷ” grey button before logging the Admin's account out “Bạn có chắc chắn muốn đăng xuất?” 
If the Admin clicks the “Có” option on the screen, the system will log the Admin out of the system. After logging out, Admin will be redirected to the login page.
If the Admin clicks the “Hủy” option on the screen, The system returns the admin to the home screen interface.
US09:     User Story For Notification function On EquipEase: Koala Education Centre.
As an administrator, I want to see any changes to the website about who was changed, the time of change, and the date of change when I use the notification function.
Acceptance criteria:
The notification function must be displayed next to the Homepage on the main bar of the website.
All notifications need to be displayed immediately when someone changes the device's information.
Each notification will be displayed below the green boxes. In the cells containing information about who changed, updated, or deleted... devices are available in layers. As: Admin account + Action(đã thêm/ đã xoá/ đã cập nhật) + “Tên thiết bị”. This notification will be displayed with a rating number from 1 to N. The newest notification will be displayed at the top and numbered 1.
In addition, if when updating the number of devices, the device is missing, there will be a specific message: “Thuộc tính” +” từ … thành …”


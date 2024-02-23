<!-- Main Guide Content -->
<div class="w-full lg:w-3/4 pr-4">
            <!-- Guide: Troubleshooting Wi-Fi Connection Issues -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-8">
                    <h2 class="text-2xl font-bold mb-4">Troubleshooting Wi-Fi Connection Issues</h2>
                    <p class="mb-4">Struggling with a spotty Wi-Fi connection can be incredibly frustrating. Before you consider throwing your router out the window, try these simple troubleshooting steps to get back online.</p>
                    
                    <!-- Step 1 -->
                    <div class="mb-6">
                        <h3 class="font-semibold text-lg mb-2">Step 1: Check Your Router</h3>
                        <p>Ensure your router is plugged in and turned on. Sometimes, the solution is as simple as restarting your router. Unplug it, wait for 30 seconds, and plug it back in.</p>
                    </div>
                    
                    <!-- Step 2 -->
                    <div class="mb-6">
                        <h3 class="font-semibold text-lg mb-2">Step 2: Verify Wi-Fi Connection on Your Device</h3>
                        <p>Make sure your device is not in Airplane Mode and that Wi-Fi is turned on. Try forgetting the network and reconnecting to it.</p>
                    </div>
                    
                    <!-- Step 3 -->
                    <div class="mb-6">
                        <h3 class="font-semibold text-lg mb-2">Step 3: Check for Interference</h3>
                        <p>Other electronic devices and certain structures can interfere with your Wi-Fi signal. Try moving your router to a different location or removing obstacles between your router and the device.</p>
                    </div>
                    
                    <!-- Conclusion -->
                    <div class="mb-6">
                        <h3 class="font-semibold text-lg mb-2">Conclusion</h3>
                        <p>If you've tried these steps and still experience issues, it might be time to contact your ISP or consider upgrading your router. Remember, diagnosing network issues can sometimes be complex, so patience is key.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sidebar for Navigation and Utilities -->
        <div class="w-full md:w-1/4 p-6">
            <h3 class="font-semibold text-xl mb-4">Guide Tools</h3>
            <!-- Language Selection Dropdown -->
            <div class="mb-4">
                <label for="language-select" class="block text-sm font-medium text-gray-700">Change Language</label>
                <select id="language-select" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option>English</option>
                    <option>Spanish</option>
                    <option>French</option>
                    <!-- More languages as needed -->
                </select>
            </div>
            <!-- Print Button -->
            <div class="mb-4">
                <button onclick="window.print()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <?php echo $translations['print_guide']; ?>
                </button>
            </div>
            <!-- Guide Contents Navigation -->
            <h3 class="font-semibold text-xl mb-4">Guide Contents</h3>
            <ul class="mb-4">
                <li><a href="#step1" class="text-blue-500 hover:text-blue-700">Check Your Router</a></li>
                <li><a href="#step2" class="text-blue-500 hover:text-blue-700">Verify Wi-Fi Connection</a></li>
                <li><a href="#step3" class="text-blue-500 hover:text-blue-700">Check for Interference</a></li>
                <li><a href="#conclusion" class="text-blue-500 hover:text-blue-700">Conclusion</a></li>
            </ul>
        </div>
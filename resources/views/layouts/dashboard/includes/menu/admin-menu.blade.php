<li class="nav-item">
    <a class="nav-link menu-link" href="{{ route("admin.dashboard") }}">
      <i class="ri-dashboard-2-line"></i>
      <span data-key="t-widgets">Dashboard</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link menu-link" href="#sidebarAgent" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAgent">
      <i class="ri-user-2-fill "></i>
      <span data-key="t-dashboards">Agents</span>
    </a>
    <div class="collapse menu-dropdown" id="sidebarAgent">
      <ul class="nav nav-sm flex-column">
        <li class="nav-item">
          <a href="{{ route("admin.agents") }}" class="nav-link" data-key="t-agents"> Agents </a>
        </li>
        <li class="nav-item">
          <a href="{{ route("admin.agent.create") }}" class="nav-link" data-key="t-add-agent"> Add Agent </a>
        </li>
      </ul>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link menu-link" href="#sideTicket" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sideTicket">
      <i class="ri-ticket-2-line"></i>
      <span data-key="t-tickets">Tickets</span>
    </a>
    <div class="collapse menu-dropdown" id="sideTicket">
      <ul class="nav nav-sm flex-column">
        <li class="nav-item">
          <a href="{{ route("admin.ticket") }}" class="nav-link" data-key="t-tickets"> All Tickets </a>
        </li>
      </ul>
    </div>
  </li>
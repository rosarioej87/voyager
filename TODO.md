This Todo list does **not** contain big improvements.  
It only contains small things that came to our minds which we couldn't implement immediately and would be forgotten otherwise.  
Instead, they are listed here:

- Test everything on mobile (especially media manager)
- Modal should show scrollbar inside container, not outside
- Measure bread loading times and cache them if necessary
- Media manager: While uploading files, they are shown in every folder
- Media manager: When navigating through folders, it is not possible to use browser-back
- Media manager: X and Y offset for watermarks should be percentage(?)
- Media manager: Lightbox should scale images when they are too big
- Ordering only works when there are actual values in the field. Those have to be set by a mutator (or similar)

## Formfields
- **Relationship** support polymorphic relationships
- **Color Picker**
- **Date/Time Picker**
- **Masked input**
- **Repeater** should "simply" use another view

## Documentation
- Scopes need to start with `scope` (ex. `scopeCurrentUser()`)
- Accessors need to be named `getFieldAttribute` (ex. `getFullNameAttribute`)
- Computed properties need to implement an accessor AND mutator when used for adding or editing
- Press escape or double-click (most) search inputs to clear them
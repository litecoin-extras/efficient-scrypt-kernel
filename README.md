efficient-scrypt-kernel
=======================

WARNING: For AMD/ATI Cards only.

Hey guys,

I have set up this repository, to work with you towards a more efficient scrypt kernel for AMD GPUS.

The first iteration of changes includes:
- Stick to LOOKUP GAP = 2, elimnated all logic that does lookup-gap distinction.
- Use a new "double-salsa" function which works fine with lookup gap 2.
  This way we save several instructions, and two functions calls to salsa(). More precisely we can substitute two loops by one,
  and avoid writing/reading one cycle to B[] array.
- Turned on the extension cl_amd_media_ops.
- Using this extension, the scrypt is now work with the amd specific (and faster) instruction set. Most often used, the rotation
  function now substituted by amd_bitalign()


  I hope as many people as possible contribute to this project ;-) Lets sqeeze the last bit out of our GPUs.